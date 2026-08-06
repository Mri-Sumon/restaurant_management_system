<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\BookingDetail;
use App\Models\BookingMaster;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerBookingController extends Controller
{
    public function index(Request $request)
    {
        $detailClauses = "";
        if (!empty($request->bookingStatus) && $request->bookingStatus == 'booked') {
            $detailClauses .= " and bkd.booking_status = '$request->bookingStatus'";
        } else if (!empty($request->bookingStatus) && $request->bookingStatus == 'checkinRecord') {
            $detailClauses .= " and bkd.booking_status = '$request->bookingStatus'";
        }

        if (!empty($request->checkoutDate)) {
            $checkout_date = $request->checkoutDate . ' 11:59:00';
            $detailClauses .= " and bkd.checkout_date = '$checkout_date'";
        }

        $clauses = "";
        if (!empty($request->dateFrom) && !empty($request->dateTo)) {
            $clauses .= " and bkm.date between '$request->dateFrom' and '$request->dateTo'";
        }
        if (!empty($request->customerId)) {
            $clauses .= " and bkm.customer_id = '$request->customerId'";
        }
        if (!empty($request->invoice)) {
            $clauses .= " and bkm.invoice like '$request->invoice%'";
        }
        if (!empty($request->id)) {
            $clauses .= " and bkm.id = '$request->id'";
        }
        $bookings = DB::select("select bkm.*,
                                c.code as customer_code,
                                ifnull(c.name, '') as customer_name,
                                ifnull(c.phone, '') as customer_phone,
                                ifnull(c.nid, '') as customer_nid,
                                ifnull(c.address, '') as customer_address,
                                ifnull(u.username, '') as addBy
                                from booking_masters bkm
                                left join customers c on c.id = bkm.customer_id
                                left join users u on u.id = bkm.added_by
                                where bkm.status = 'a' $clauses 
                                order by bkm.id desc");


        foreach ($bookings as $key => $booking) {
            $booking->booking_details = DB::select("select bkd.*,
                                                        rm.code as room_code,
                                                        rm.name as room_name,
                                                        tp.name as type_name,
                                                        c.name as category_name
                                                        from booking_details bkd
                                                        left join rooms rm on rm.id = bkd.room_id
                                                        left join room_types tp on tp.id = rm.room_type_id
                                                        left join categories c on c.id = rm.category_id
                                                        where bkd.status = 'a'
                                                        and bkd.booking_id = ?
                                                        $detailClauses", [$booking->id]);

            if (!empty($request->id)) {
                $booking->othercustomer = DB::select("select oc.*
                                                from other_customers oc
                                                where oc.booking_id = ?", [$booking->id]);
            }

            if (count($booking->booking_details) == 0) {
                unset($bookings[$key]);
            }
        }

        return response()->json(array_values($bookings));
    }

    public function getCategory(Request $request)
    {
        $categories = DB::table('categories')->orderBy('id', 'DESC')->get();
        return response()->json($categories);
    }

    public function roomList(Request $request)
    {
        $clauses = "";
        if (!empty($request->floorId)) {
            $clauses .= " and r.floor_id = '$request->floorId'";
        }
        if (!empty($request->typeId)) {
            $clauses .= " and r.room_type_id = '$request->typeId'";
        }

        if (!empty($request->categoryId)) {
            $clauses .= " and r.category_id = '$request->categoryId'";
        }

        $checkin_date = $request->checkin_date . ' 12:00:00';

        $rooms = DB::select("select r.*,
                                rt.name as roomtype_name,
                                f.name as floor_name,
                                c.name as category_name
                                from rooms r
                                left join room_types rt on rt.id = r.room_type_id
                                left join floors f on f.id = r.floor_id
                                left join categories c on c.id = r.category_id
                                where r.status != 'd' and r.deleted_at is null
                                $clauses
                                ");

        foreach ($rooms as  $item) {
            $roomcheckin = DB::select("select * from booking_details bkd where bkd.checkout_status = 'false' and bkd.room_id = ?", [$item->id]);
            $item->checkin = 'false';
            if (count($roomcheckin) > 0) {
                $checkin = DB::select("select * from booking_details bkd where bkd.checkout_status = 'false' and '$checkin_date' between bkd.checkin_date and bkd.checkout_date and bkd.room_id = ?", [$item->id]);
                $item->checkin = count($checkin) > 0 ? 'true' : 'false';
            }
            $roombooked = DB::select("select * from rooms rm where rm.id in (select bkd.room_id from booking_details bkd where bkd.status = 'a' and bkd.booking_status = 'booked' and '$checkin_date' between bkd.checkin_date and bkd.checkout_date) and rm.id = ?", [$item->id]);
            $item->booked = count($roombooked) > 0 ? 'true' : 'false';

            // $roomavailable = DB::select("select * from rooms rm where rm.id not in (select bkd.room_id from booking_details bkd where bkd.status = 'a' or bkd.checkout_status = 'true' and '$checkin_date' between bkd.checkin_date and bkd.checkout_date) and rm.id = ?", [$item->id]);
            $item->available = 'false';
            if ($item->checkin == 'false' && $item->booked == 'false') {
                $item->available = 'true';
            }


            if ($item->available == 'true') {
                $item->color = "#aee2ff";
            } else if ($item->booked == 'true') {
                $item->color = '#fffcb2';
            } else if ($item->checkin == 'true') {
                $item->color = '#ff0000ab';
            } else {
                $item->color = "#aee2ff";
            }
        }

        return response()->json($rooms, 200);
    }


    public function store(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            Session::forget([
                'checkin_date',
                'checkout_date',
                'room'
            ]);
            Session::put([
                'checkin_date'  => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'room'          => $request->room
            ]);

            return response()->json(['status' => true, 'message' => "Booking added successfully"]);
        } else {
            return response()->json(['status' => false, 'loginStatus' => true, 'message' => 'Login first']);
        }
    }

    public function confirm(Request $request)
    {
        if ($request->method() == 'GET') {
            if (Session::get('room') == '') {
                return back();
            }
            $data = array(
                'checkin_date' => Session::get('checkin_date'),
                'checkout_date' => Session::get('checkout_date'),
                'room' => Session::get('room')
            );
            $days = Carbon::parse(Session::get('checkout_date'))->diffInDays(Session::get('checkin_date'), 'days');
            $days = $days == 0 ? 1 : $days;
            $data['days'] = $days;

            return view('pages.confirm_booking', $data);
        } else {
            if (Auth::check()) {
                try {
                    DB::beginTransaction();
                    $room = (object) Session::get('room');
                    $checkin_date = Session::get('checkin_date') . ' 12:00:00';
                    $checkout_date = Session::get('checkout_date') . ' 11:59:00';
                    $days = Carbon::parse(Session::get('checkout_date'))->diffInDays(Session::get('checkin_date'), 'days');
                    $days = $days == 0 ? 1 : $days;


                    $booking                 = new BookingMaster();
                    $booking->date           = date("Y-m-d");
                    $booking->subtotal       = $room->price;
                    $booking->total          = $room->price;
                    $booking->advance        = 0;
                    $booking->due            = $room->price;
                    $booking->customer_id    = Auth::user()->id;
                    $booking->invoice        = invoiceGenerate('Booking_Master', '');
                    $booking->is_other       = 'false';
                    $booking->others_member  = 0;
                    $booking->note           = $request->note;
                    $booking->last_update_ip = request()->ip();
                    $booking->save();

                    // booking details here
                    $detail                  = new BookingDetail();
                    $detail->booking_id      = $booking->id;
                    $detail->room_id         = $room->id;
                    $detail->checkin_date    = $checkin_date;
                    $detail->checkout_date   = $checkout_date;
                    $detail->days            = $days;
                    $detail->unit_price      = $room->price;
                    $detail->total           = $room->price * $days;
                    $detail->checkout_status = 'false';
                    $detail->booking_status  = 'booked';
                    $detail->last_update_ip  = request()->ip();
                    $detail->save();

                    DB::commit();
                    Session::flash("success", "Booking confirm successfully");
                    return redirect()->route('get.bookingInvoice', $booking->id);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'message' => 'Something went wrong' . $th->getMessage()]);
                }
            } else {
                return response()->json(['status' => false, 'loginStatus' => true, 'message' => 'Login first']);
            }
        }
    }

    public function bookingInvoice($id)
    {
        $booking_master = DB::select("select * from booking_masters where id = ?", [$id]);
        $booking_details = DB::select("select bkd.*,
                            rm.code as room_code,
                            rm.name as room_name,
                            tp.name as floor_name,
                            tp.name as type_name,
                            c.name as category_name
                            from booking_details bkd
                            left join rooms rm on rm.id = bkd.room_id
                            left join floors f on f.id = rm.floor_id
                            left join room_types tp on tp.id = rm.room_type_id
                            left join categories c on c.id = rm.category_id
                            where bkd.status = 'a'
                            and bkd.booking_id = ?", [$id]);

        if (count($booking_master) > 0) {
            return view('pages.confirm_booking_message', compact('booking_details', 'booking_master'));
        } else {
            return back();
        }
    }
}

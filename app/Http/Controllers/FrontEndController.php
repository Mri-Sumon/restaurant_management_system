<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CateringDesp;
use App\Models\CocktailCategory;
use App\Models\CocktailDesp;
use App\Models\Customer;
use App\Models\FrontendBgImage;
use App\Models\Menu;
use App\Models\Gallery;
use App\Models\Lunch;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PrivacyPolicy;
use App\Models\TableBooking;
use App\Models\TermAndCondition;
use App\Models\TermsAndCondition;
use App\Models\WebsiteMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class FrontEndController extends Controller
{
    public function home()
    {
        $data['lunch'] = Lunch::first();
        $data['Blog'] = Blog::latest()->take(3)->get();
        $data['CateringDesp'] = CateringDesp::first();
        $data['CocktailDesp'] = CocktailDesp::first();
        $data['gallery'] = Gallery::latest()->get();
        $data['image'] = AboutPage::first();
        return view('pages.index', $data);
    }
    public function checkout()
    {
        return view('pages.checkout');
    }
    public function aboutUs()
    {
        return view('pages.about');
    }
    public function location()
    {
        return view('pages.location');
    }
    public function menu()
    {
        return view('pages.menu');
    }
    public function cocktailMenu()
    {
        $data['CocktailCategory'] = CocktailCategory::get();
        return view('pages.cocktail_menu',$data);
    }
    public function photos()
    {
        $data['photos'] = Gallery::latest()->get();
        return view('pages.web_gallery',  $data);
    }
    public function blogs(Request $request)
    {
        $data = $request->all();
        $content['category'] = BlogCategory::all();
        $content['blog'] = Blog::where(function($search) use ($data){
            // Search Input Check
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('title', 'like', '%'.$data['q'].'%');
                });
            }
            // Search Category Check
            if(!empty($data['c']) && $data['c'] != '' && $data['c'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('blog_category_id', $data['c']);
                });
            }
        })->get();
        return view('pages.blogs',$content);
    }
    public function blog_details($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        return view('pages.blog_details',[
            'blog' => $blog,
        ]);
    }

    public function privacy()
    {
        $privacyPolicy = PrivacyPolicy::latest()->get();
        return view('pages.privacy',compact('privacyPolicy'));
    }

    public function terms()
    {
        $terms = TermsAndCondition::all();
        return view('pages.terms', compact('terms'));
    }


    public function contact()
    {
        return view('pages.contact');
    }

    public function storeMessage(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:500',
            // 'g-recaptcha-response' => 'required|string',
        ]);

        // Verify reCAPTCHA
        // $recaptchaSecret = env('RECAPTCHA_SECRET');
        // $recaptchaResponse = $request->input('g-recaptcha-response');
        // $googleUrl = 'https://www.google.com/recaptcha/api/siteverify';

        // $response = Http::asForm()->post($googleUrl, [
        //     'secret' => $recaptchaSecret,
        //     'response' => $recaptchaResponse,
        // ]);

        // $recaptchaResult = $response->json();

        // if (!$recaptchaResult['success']) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Invalid reCAPTCHA. Please try again.',
        //     ], 422);
        // }

        try {
            WebsiteMessage::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
            ]);

            return response()->json([
                'status' => true,
                'message' => "Message submitted successfully!",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function bookingStore(Request $request)
    {
        $data = $request->all();
        Session::forget([
            'booking'
        ]);
        Session::put([
            'booking'  => $data
        ]);

        $session_data = Session::get('booking');
        if ($session_data) {
            return response()->json(['status' => true, 'message' => "Booking Submit Successfull"]);
            // if (Auth::check()) {
            //     return response()->json(['status' => true, 'message' => "Booking Submit Successfull"]);
            // } else {
            //     return response()->json(['status' => false, 'loginStatus' => true, 'message' => 'Login first']);
            // }
        }
    }

    public function confirmBooking()
    {
        $data['booking_info'] = Session::get('booking');
        return view('pages.booking', $data);
    }

    public function makeBooking(Request $request)
    {
        // if (!Auth::check()) {
        //     return back()->with('error', 'Please log in first!');
        // }

        $book = Session::get('booking');
        if (!$book || !isset($book['name'], $book['phone'], $book['booking_date'], $book['booking_time'])) {
            return back()->with('error', 'Incomplete booking information.');
        }

        try {
            DB::beginTransaction();

            $booking = new TableBooking();
            $booking->invoice = invoiceGenerate('table_booking', '');
            $booking->date = $book['date'];
            $booking->customer_id = Auth::guard('customer')->check() ? Auth::guard('customer')->user()->id : 0;
            $booking->name = $book['name'];
            $booking->email = Auth::guard('customer')->check() ? ($book['email'] == '' ? Auth::guard('customer')->user()->email : $book['email']) : null;
            $booking->phone = $book['phone'];
            $booking->persons = $book['persons'];
            $booking->booking_date = $book['booking_date'];
            $booking->booking_time = $book['booking_time'];
            $booking->note = $request->note;
            $booking->last_update_ip = $request->ip();
            $booking->save();

            DB::commit();

            return redirect('/')->with('success', 'Reservation Successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong!')->withErrors($th->getMessage());
        }
    }

    public function getCaptcha(Request $request)
    {
        $data = $this->createCaptcha($request);
        return response()->json($data);
    }

    public function createCaptcha($request)
    {
        $request = (object) $request;
        Session::forget('first_code');
        Session::forget('second_code');

        $first = rand(1, 15);
        $second = rand(1, 15);

        Session::put('first_code', $first);
        Session::put('second_code', $second);

        $data = array(
            'first_code'  => Session::get('first_code'),
            'second_code' => Session::get('second_code'),
        );
        return $data;
    }

    public function getCategories()
    {
        $categorie = MenuCategory::take(6)->with('rel_to_menus.recipes.material')->latest()->get();
        return response()->json($categorie);
    }
    public function getMenus()
    {
        $menu = Menu::latest()->with(['category', 'recipes.material'])->get();
        return response()->json($menu);
    }
    public function getCustomer()
    {
        $customer = Auth::guard('customer')->check()
            ? Auth::guard('customer')->user()
            : '';

        return response()->json($customer);
    }

    public function orderConfirm(Request $request)
    {
        // customer info
        $req = $request->input('order');
        $customerInfo = Customer::where('phone', $req['customer_phone'])->first();
        if (isset($customerInfo)) {
            $customerId = $customerInfo->id;
        } else {
            $data = [
                'code'            => generateCode('Customer', 'C'),
                'name'            => $req['customer_first_name'] . ' ' . $req['customer_last_name'],
                'first_name'      => $req['customer_first_name'],
                'last_name'       => $req['customer_last_name'],
                'email'           => $req['customer_email'],
                'phone'           => $req['customer_phone'],
                'city'            => $req['customer_city'],
                'address'         => $req['customer_address'],
                'address_line_II' => $req['customer_address_II'] ?? null,
                'state'           => $req['customer_state'],
                'zip'             => $req['customer_zip'],
                'password'        => Hash::make(1),
                'added_by'        => 1,
                'last_update_ip'  => $request->ip(),
            ];
            $cus = Customer::create($data);
            $customerId = $cus->id;
        }

        Auth::guard('customer')->loginUsingId($customerId);

        // dd(Auth::guard('customer')->user());


        if (Auth::guard('customer')->check()) {
            try {
                DB::beginTransaction();
                // Create Order
                $order = new Order();
                $order->invoice = invoiceGenerate("Order", 'O');
                $order->date = date('Y-m-d');
                $order->customer_id = Auth::guard('customer')->id();
                $order->customer_name = $request->input('order.customer_first_name') . ' ' . $request->input('order.customer_last_name');
                $order->customer_phone = $request->input('order.customer_phone');
                $order->customer_address = $request->input('order.customer_address');
                $order->sub_total = $request->input('order.subtotal');
                $order->charge = 0;
                $order->total = $request->input('order.total');
                $order->due = $request->input('order.total');
                $order->note = $request->input('order.note');
                $order->status = 'p';
                $order->order_type = $request->input('order.order_type');
                $order->time = $request->input('order.order_type') === 'ta' ? $request->input('order.time') : null;
                $order->last_update_ip = $request->ip();
                $order->save();

                // Create Order Details
                foreach ($request->input('carts') as $cart) {
                    $menuItem = Menu::find($cart['menuId']);
                    if ($menuItem) {
                        $detail = new OrderDetails();
                        $detail->order_id = $order->id;
                        $detail->menu_id = $cart['menuId'];
                        $detail->price = $menuItem->sale_rate;
                        $detail->quantity = $cart['quantity'];
                        $detail->status = 'p';
                        $detail->total = $cart['quantity'] * $menuItem->sale_rate;
                        $detail->last_update_ip = $request->ip();
                        $detail->save();
                    }
                }

                DB::commit();
                return response()->json(['status' => true, 'message' => "Your order has been confirmed"]);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => false, 'loginStatus' => true, 'message' => 'Please log in first']);
        }
    }

    public function booking_cancel($id)
    {
        $cancel = TableBooking::find($id)->update([
            'status' => 'c'
        ]);
        if ($cancel) {
            return back()->with('success', 'Booking Cancel Successful');
        }
    }

    public function order_cancel($id)
    {
        $cancel = Order::find($id)->update([
            'status' => 'c'
        ]);
        if ($cancel) {
            return back()->with('success', 'Order Cancel Successful');
        }
    }

    public function order_invoice($id)
    {
        $data['order'] = Order::find($id);
        $data['details'] = OrderDetails::where('order_id', $id)->get();
        return view('pages.invoice', $data);
    }
}

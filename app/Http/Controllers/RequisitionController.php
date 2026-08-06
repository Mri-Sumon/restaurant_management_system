<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequisitionRequest;
use App\Models\RequisitionDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RequisitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!checkAccess('requisitionList')) {
            return view('error.unauthorize');
        }
        return view('administration.restaurant.requisitionList');
    }

    public function create($id = 0)
    {
        if (!checkAccess('requisition')) {
            return view('error.unauthorize');
        }
        $check = Requisition::where('id', $id)->first();
        if (empty($check)) {
            if ($id != 0) {
                Session::flash('error', 'Requisition not found');
            }
            $id = 0;
        }
        $invoice = invoiceGenerate("Requisition", 'R');
        return view('administration.restaurant.requisionCreate', compact('id', 'invoice'));
    }

    public function get(Request $request)
    {
        try {
            $whereCluase = [];
            if (!empty($request->id)) {
                array_push($whereCluase, ['id', '=', $request->id]);
            }
            if (!empty($request->invoice)) {
                array_push($whereCluase, ['invoice', 'LIKE', $request->invoice . '%']);
            }
            if (!empty($request->supplierId)) {
                array_push($whereCluase, ['supplier_id', '=', $request->supplierId]);
            }
            if (!empty($request->userId)) {
                array_push($whereCluase, ['added_by', '=', $request->userId]);
            }
            if (!empty($request->status)) {
                array_push($whereCluase, ['status', '=', $request->status]);
            } else {
                array_push($whereCluase, ['status', '!=', 'd']);
            }
            if (!empty($request->dateFrom) && !empty($request->dateTo)) {
                array_push($whereCluase, ['date', '>=', $request->dateFrom]);
                array_push($whereCluase, ['date', '<=', $request->dateTo]);
            }

            if ((!empty($request->recordType) && $request->recordType == 'with') || !empty($request->id)) {
                $requisition = Requisition::with('requisitionDetails', 'supplier', 'employee', 'user')->where($whereCluase)->latest('id');
            } else {
                $requisition = Requisition::with('supplier', 'employee', 'user')->where($whereCluase)->latest('id');
            }

            if (!empty($request->forSearch)) {
                $req = $requisition->limit(20)->get();
            } else {
                $req = $requisition->get();
            }
            // dd($request->all(),$req);

            foreach ($req as $key => $item) {
                if ($item->supplier_id != null || $item->supplier_id != '') {
                    $item->supplier = DB::select("select * from suppliers where id = ?", [$item->supplier_id])[0];
                } else {
                    $item->supplier = null;
                }
            }
            return response()->json($req);
        } catch (\Throwable $th) {
            return send_error("Something went wrong". $th->getMessage());
        }
    }

    public function details(Request $request)
    {
        try {
            $whereCluase = "";
            if (!empty($request->supplierId)) {
                $whereCluase .= " AND s.id = '$request->supplierId'";
            }

            if (!empty($request->materialId)) {
                $whereCluase .= " AND m.id = '$request->materialId'";
            }

            if (!empty($request->status)) {
                $whereCluase .= " AND rd.status = '$request->status'";
            }

            if (!empty($request->dateFrom) && !empty($request->dateTo)) {
                $whereCluase .= " AND r.date BETWEEN '$request->dateFrom' AND '$request->dateTo'";
            }
            $details = DB::select("SELECT
                        rd.*,
                        m.name,
                        r.invoice,
                        r.date,
                        s.code as supplier_code,
                        s.name as supplier_name
                    FROM requisition_details rd
                    LEFT JOIN materials m ON m.id = rd.material_id
                    LEFT JOIN requisitions r ON r.id = rd.requisition_id
                    LEFT JOIN suppliers s ON s.id = r.supplier_id
                    WHERE rd.status != 'd'
                    $whereCluase");
            return response()->json($details);
        } catch (\Throwable $th) {
            return send_error("Something went wrong ". $th->getMessage());
        }
    }

    public function invoicePrint($id)
    {
        if (!checkAccess('requisitionInvoice')) {
            return view('error.unauthorize');
        }
        return view("administration.restaurant.requisitionInvoice", compact('id'));
    }

    public function store(RequisitionRequest $request)
    {
        if (!$request->validated()) return send_error("Validation Error", $request->validated(), 422);
        $checkInvoice = Requisition::where('invoice', $request->requisition['invoice'])->first();
        $invoice = $request->requisition['invoice'];
        if (!empty($checkInvoice)) {
            $invoice = invoiceGenerate("Requisition", 'R');
        }

        try {

            DB::beginTransaction();
            //Requisition master
            $requisitionKey = $request->requisition;
            $requisition = new Requisition();
            unset($requisitionKey['id']);
            unset($requisitionKey['invoice']);
            foreach ($requisitionKey as $key => $item) {
                $requisition->$key = $item;
            }
            $requisition->invoice = $invoice;
            $requisition->added_by = Auth::user()->id;
            $requisition->last_update_ip = request()->ip();
            $requisition->status = 'p';
            $requisition->save();

            // Requisition detail
            foreach ($request->carts as $cart) {
                unset($cart['name']);
                unset($cart['unitName']);
                $detail = new RequisitionDetails();
                foreach ($cart as $key => $item) {
                    $detail->$key = $item;
                }
                $detail->requisition_id = $requisition->id;
                $detail->added_by = Auth::user()->id;
                $detail->last_update_ip = request()->ip();
                $detail->save();
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Requisition insert successfully.!', 'id' => $requisition->id], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return send_error("Something went wrong ". $th->getMessage());
        }
    }

    public function update(RequisitionRequest $request)
    {
        if (!$request->validated()) return send_error("Validation Error", $request->validated(), 422);

        try {
            DB::beginTransaction();

            //requisition master
            $requisitionKey = $request->requisition;
            $requisition = Requisition::find($request->requisition['id']);
            unset($requisitionKey['id']);
            foreach ($requisitionKey as $key => $item) {
                $requisition->$key = $item;
            }

            $requisition->updated_by = Auth::user()->id;
            $requisition->updated_at = Carbon::now();
            $requisition->last_update_ip = request()->ip();
            $requisition->update();

            // Old requisition detail
            $olddetail = RequisitionDetails::where('requisition_id', $request->requisition['id'])->get();
            foreach ($olddetail as $item) {
                // old detail delete
                RequisitionDetails::find($item->id)->forceDelete();
            }

            // Purchase detail
            foreach ($request->carts as $cart) {
                unset($cart['name']);
                unset($cart['unitName']);
                $detail = new RequisitionDetails();
                foreach ($cart as $key => $item) {
                    $detail->$key = $item;
                }
                $detail->requisition_id = $requisition->id;
                $detail->added_by = Auth::user()->id;
                $detail->last_update_ip = request()->ip();
                $detail->save();
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Requisition update successfully.', 'id' => $requisition->id], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return send_error("Something went wrong ". $th->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Requisition::find($request->id);
            $data->status = 'd';
            $data->last_update_ip = request()->ip();
            $data->deleted_by = Auth::user()->id;
            $data->update();

            //old purchase detail
            $details = RequisitionDetails::where('requisition_id', $request->id)->get();
            foreach ($details as $item) {
                // old details delete
                $detail = RequisitionDetails::find($item->id);
                $detail->status = 'd';
                $detail->last_update_ip = request()->ip();
                $detail->deleted_at = Carbon::now();
                $detail->deleted_by = Auth::user()->id;
                $detail->update();
            }

            $data->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Requisition delete successfully.'], 200);
        } catch (\Throwable $th) {
            return send_error("Something went wrong ". $th->getMessage());
            DB::rollBack();
        }
    }

    public function status(Request $request){
        try {
            $user = Auth::user();
            $data = Requisition::find($request->id);
            if ($user->role == 'Superadmin') {
                $data->admin_status = 'a';
            }
            if ($user->role == 'manager') {
                $data->manager_status = 'a';
            }

            if ($data->manager_status == 'a' && $data->admin_status = 'a') {
                $data->status = 'a';
            }

            $data->update();
            return response()->json(['status' => true, 'message' => 'Requisition delete successfully.'], 200);
        } catch (\Throwable $th) {
            return send_error("Something went wrong ". $th->getMessage());
        }
    }

}

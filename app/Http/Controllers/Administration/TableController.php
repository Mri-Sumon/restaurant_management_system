<?php

namespace App\Http\Controllers\Administration;

use App\Models\Bench;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\TableRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $clauses = "";
        if (!empty($request->floorId)) {
            $clauses .= " and t.floor_id = '$request->floorId'";
        }
        if (!empty($request->inchargeId)) {
            $clauses .= " and t.incharge_id = '$request->inchargeId'";
        }
        if (!empty($request->tabletypeId)) {
            $clauses .= " and t.bench_type_id = '$request->tabletypeId'";
        }
        if (!empty($requestbenchId)) {
            $clauses .= " and t.id = '$requestbenchId'";
        }

        $benches = DB::select("select t.*,
                f.name as floor_name,
                e.name as incharge_name,
                rt.name as tabletype_name
            from benches t
            left join floors f on f.id = t.floor_id
            left join employees e on e.id = t.incharge_id
            left join bench_types rt on rt.id = t.bench_type_id
            where t.status != 'd' and t.deleted_at is null 
            $clauses");

        foreach ($benches as $table) {
            $table->chairs = DB::select("select c.* from chairs c
            where c.status = 'a' and c.deleted_at is null
            and c.bench_id = ? ", [$table->id]);
        }

        return response()->json($benches, 200);
    }

    public function create()
    {
        if (!checkAccess('table')) {
            return view('error.unauthorize');
        }

        return view('administration.table.create');
    }

    public function store(TableRequest $request)
    {
        // dd($request);

        if (!$request->validated()) return send_error("Validation Error", $request->validated(), 422);
        $exists = Bench::where('name', $request->name)
            ->where('floor_id', $request->floor_id)
            ->exists();
        if ($exists) {
            return response()->json(['status' => true, 'message' => "The table name must be unique for the given floor!"], 422);
        }
        try {
            $check = DB::table('benches')->where('deleted_at', '!=', NULL)->where('name', $request->name)->first();
            if (!empty($check)) {
                DB::select("UPDATE benches SET deleted_by = NULL, deleted_at = NULL , status = 'a' WHERE id = ?", [$check->id]);
            } else {
                $data     = new Bench();
                $tableKeys = $request->except('id', 'image');
                foreach (array_keys($tableKeys) as $key) {
                    $data->$key = $request->$key;
                }

                if ($request->hasFile('image')) {
                    $data->image = imageUpload($request, 'image', 'uploads/table', trim($data->code));
                }
                $data->added_by       = Auth::user()->id;
                $data->last_update_ip = request()->ip();
                $data->save();
            }

            return response()->json(['status' => true, 'message' => 'Table insert successfully', 'code' => generateCode('Bench', 'T')], 200);
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }
    public function update(TableRequest $request)
    {
        if (!$request->validated()) return send_error("Validation Error", $request->validated(), 422);
        $exists = Bench::where('name', $request->name)
            ->where('floor_id', $request->floor_id)
            ->where('id', '!=', $request->id)
            ->exists();
        if ($exists) {
            return response()->json(['status' => true, 'message' => "The table name must be unique for the given floor!"], 422);
        }
        try {
            $data = Bench::find($request->id);
            $data->code = generateCode("Bench", 'T');
            $tableKeys = $request->except('id', 'image');
            foreach (array_keys($tableKeys) as $key) {
                $data->$key = $request->$key;
            }
            if ($request->hasFile('image')) {
                if (File::exists($data->image)) {
                    File::delete($data->image);
                }
                $data->image = imageUpload($request, 'image', 'uploads/table', trim($data->code));
            }
            $data->updated_by     = Auth::user()->id;
            $data->updated_at     = Carbon::now();
            $data->last_update_ip = request()->ip();
            $data->update();

            return response()->json(['status' => true, 'message' => 'Table update successfully', 'code' => generateCode('Bench', 'T')], 200);
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $check = DB::table('chairs')->where('bench_id', $request->id)->first();
            if (!empty($check)) {
                return response()->json(['status' => true, 'message' => "The chair is assigned under this table!"], 422);
            } else {
                $data                 = Bench::find($request->id);
                $data->status         = 'd';
                $data->last_update_ip = request()->ip();
                $data->deleted_by     = Auth::user()->id;
                $data->update();

                $data->delete();
                return response()->json("Table delete successfully", 200);
            }
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function tableList()
    {
        if (!checkAccess('tableList')) {
            return view('error.unauthorize');
        }

        return view('administration.table.tablelist');
    }

    public function getTableList(Request $request)
    {
        $clauses = "";
        if (!empty($request->floorId)) {
            $clauses .= " and t.floor_id = '$request->floorId'";
        }
        if (!empty($request->typeId)) {
            $clauses .= " and t.bench_type_id = '$request->typeId'";
        }

        if (!empty($request->inchargeId)) {
            $clauses .= " and t.incharge_id = '$request->inchargeId'";
        }

        $floors = DB::select("select f.* from floors f where f.status = 'a'");

        foreach ($floors as $key => $floor) {
            $floor->benches = DB::select("select t.*,
                                tt.name as tabletype_name
                                from benches t
                                left join bench_types tt on tt.id = t.bench_type_id
                                where t.status != 'd' and t.deleted_at is null
                                and t.floor_id = ?
                                $clauses
                                ", [$floor->id]);

            foreach ($floor->benches as  $item) {
                $tablebooked = DB::select("select * from benches tt where tt.id in (select ot.bench_id from orders ot where ot.status = 'p') and tt.id = ?", [$item->id]);
                $item->booked = count($tablebooked) > 0 ? 'true' : 'false';

                $item->available = 'false';
                if ($item->booked == 'false') {
                    $item->available = 'true';
                }

                if ($item->available == 'true') {
                    $item->color = "#aee2ff";
                } else if ($item->booked == 'true') {
                    $item->color = '#fffcb2';
                } else {
                    $item->color = "#aee2ff";
                }
            }
        }

        return response()->json($floors, 200);
    }
}

<?php

namespace App\Http\Controllers\Administration;

use App\Models\Chair;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\ChairRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ChairController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $clauses = "";
        if (!empty($requestbenchId)) {
            $clauses .= " and c.bench_id = '$requestbenchId'";
        }

        $chairs = DB::select("select c.*, t.name as table_name
            from chairs c
            left join benches t on t.id = c.bench_id
            where c.status != 'd' and c.deleted_at is null 
            $clauses");
        return response()->json($chairs, 200);
    }

    public function create()
    {
        if (!checkAccess('chair')) {
            return view('error.unauthorize');
        }

        return view('administration.chair.create');
    }

    public function store(ChairRequest $request)
    {
        if (!$request->validated()) return send_error("Validation Error", $request->validated(), 422);
        $exists = Chair::where('name', $request->name)
            ->where('bench_id', $request->bench_id)
            ->exists();
        if ($exists) {
            return response()->json(['status' => true, 'message' => "The chair name must be unique for the given table!"], 422);
        }
        try {
            $check = DB::table('chairs')->where('deleted_at', '!=', NULL)->where('name', $request->name)->first();
            if (!empty($check)) {
                DB::select("UPDATE chairs SET deleted_by = NULL, deleted_at = NULL , status = 'a' WHERE id = ?", [$check->id]);
            } else {
                $data     = new Chair();
                $chairKeys = $request->except('id');
                foreach (array_keys($chairKeys) as $key) {
                    $data->$key = $request->$key;
                }
                $data->added_by       = Auth::user()->id;
                $data->last_update_ip = request()->ip();
                $data->save();
            }

            return response()->json(['status' => true, 'message' => 'Chair inserted successfully', 'code' => generateCode('Chair', 'C')], 200);
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }
    public function update(ChairRequest $request)
    {
        if (!$request->validated()) return send_error("Validation Error", $request->validated(), 422);
        $exists = Chair::where('name', $request->name)
            ->where('bench_id', $request->bench_id)
            ->where('id', '!=', $request->id)
            ->exists();
        if ($exists) {
            return response()->json(['status' => true, 'message' => "The chair name must be unique for the given table!"], 422);
        }
        try {
            $data = Chair::find($request->id);
            $data->code = generateCode("Chair", 'C');
            $chairKeys = $request->except('id');
            foreach (array_keys($chairKeys) as $key) {
                $data->$key = $request->$key;
            }
            $data->updated_by     = Auth::user()->id;
            $data->updated_at     = Carbon::now();
            $data->last_update_ip = request()->ip();
            $data->update();

            return response()->json(['status' => true, 'message' => 'Chair updated successfully', 'code' => generateCode('Chair', 'C')], 200);
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data                 = Chair::find($request->id);
            $data->status         = 'd';
            $data->last_update_ip = request()->ip();
            $data->deleted_by     = Auth::user()->id;
            $data->update();

            $data->delete();
            return response()->json("Chair deleted successfully", 200);
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }
}

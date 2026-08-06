<?php

namespace App\Http\Controllers;

use App\Models\CateringDesp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CateringController extends Controller
{
    public function index()
    {
        return view('administration.website.catering');
    }

    public function get()
    {
        $CateringDesp = CateringDesp::first();
        return response()->json($CateringDesp);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }
    
        try {
            $data = $request->only(['title', 'description']);
    
            $desp = CateringDesp::first();
    
            if ($desp) {
                $desp->update($data);
            } else {
                CateringDesp::create($data);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Catering Updated Successfully',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Lunch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LunchController extends Controller
{
    public function index()
    {
        return view('administration.website.lunch');
    }

    public function get()
    {
        $lunch = Lunch::first();
        return response()->json($lunch);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lunch_time' => 'required',
            'optionA_menu' => 'required',
            'optionA_price' => 'required',
            'optionB_menu' => 'required',
            'optionB_price' => 'required',
        ]);
        if ($validator->fails()) return send_error("Validation Error", $validator->errors(), 422);
        try {
            $data = $request->except('optionA_image', 'optionB_image','optionC_image','optionD_image');
            $old  = Lunch::first();
            $data['optionA_image'] = $old != null ? $old->optionA_image : '';
            $data['optionB_image'] = $old != null ? $old->optionB_image : '';
            $data['optionC_image'] = $old != null ? $old->optionC_image : '';
            $data['optionD_image'] = $old != null ? $old->optionD_image : '';
            if ($request->hasFile('optionA_image')) {
                if ($old != null && File::exists($old->optionA_image)) {
                    File::delete($old->optionA_image);
                }
                $data['optionA_image'] = imageUpload($request, 'optionA_image', 'uploads/lunch', uniqid());
            }
            if ($request->hasFile('optionB_image')) {
                if ($old != null && File::exists($old->optionB_image)) {
                    File::delete($old->optionB_image);
                }
                $data['optionB_image'] = imageUpload($request, 'optionB_image', 'uploads/lunch', uniqid());
            }
            if ($request->hasFile('optionC_image')) {
                if ($old != null && File::exists($old->optionC_image)) {
                    File::delete($old->optionC_image);
                }
                $data['optionC_image'] = imageUpload($request, 'optionC_image', 'uploads/lunch', uniqid());
            }
            if ($request->hasFile('optionD_image')) {
                if ($old != null && File::exists($old->optionD_image)) {
                    File::delete($old->optionD_image);
                }
                $data['optionD_image'] = imageUpload($request, 'optionD_image', 'uploads/lunch', uniqid());
            }
            $data['updated_at'] = Carbon::now();
            if($old != null){
                $old->update($data);
            }else{
                Lunch::create($data);
            }

            return response()->json("Update successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }
}

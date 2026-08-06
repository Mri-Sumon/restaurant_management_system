<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\CocktailCategory;
use App\Models\CocktailDesp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CocktailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function cocktaileDesc()
    {
        return view('administration.website.cocktail_desc');
    }
    public function description(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ], [
            'description.required' => 'The description is required.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    
        try {
            $data = $request->except('cocktail_image');
            $desp = CocktailDesp::first();

            // dd($request->hasFile('cocktail_image'), $request->all());
            if ($request->hasFile('cocktail_image')) {
                if ($desp && File::exists($desp->cocktail_image)) {
                    File::delete($desp->cocktail_image);
                }
                $data['cocktail_image'] = imageUpload($request, 'cocktail_image', 'uploads/cocktail', uniqid());
            } else {
                $data['cocktail_image'] = $desp ? $desp->cocktail_image : '';
            }
            if ($request->hasFile('cocktail_video')) {
                if ($desp && File::exists($desp->cocktail_video)) {
                    File::delete($desp->cocktail_video);
                }
                $data['cocktail_video'] = imageUpload($request, 'cocktail_video', 'uploads/cocktail/video', uniqid());
            } else {
                $data['cocktail_video'] = $desp ? $desp->cocktail_video : '';
            }
    
            // Update or create the Cocktail Description
            if ($desp) {
                $desp->update($data);
            } else {
                CocktailDesp::create($data);
            }
    
            return response()->json("Cocktail Description Updated Successfully");
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong', 'details' => $th->getMessage()], 500);
        }
    }
    

    public function index()
    {
        $cocktail = Cocktail::with('category')->latest()->get();
        $cocktailDesp = CocktailDesp::first();
        return response()->json([
            'cocktail' => $cocktail,
            'cocktailDesp' => $cocktailDesp,
        ]);
    }
    public function getCategory()
    {
        $cocktail = CocktailCategory::latest()->get();
        return response()->json($cocktail);
    }

    public function create()
    {
        // if (!checkAccess('cocktail')) {
        //     return view('error.unauthorize');
        // }

        return view('administration.website.cocktail');
    }
    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'The title is required.',
        ]);

        if ($validator->fails()) {
            return send_error($validator->errors()->first());
        }
        $data = $request->except('id');
        try {
            CocktailCategory::create($data);
            return response()->json("Cocktail Category inserted successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cocktail_category_id' => 'required',
            'subtitle'             => 'required',
            'title'                => 'required',

        ], [
            'cocktail_category_id.required' => 'The category is required.',
            'subtitle.required'             => 'The subtitle is required.',
            'title.required'                => 'The title is required.',
        ]);

        if ($validator->fails()) {
            return send_error($validator->errors()->first());
        }
        $data = $request->except('id');

        try {
            $data['added_by'] = Auth::user()->id;
            $data['last_update_ip'] = request()->ip();
            Cocktail::create($data);
            return response()->json("Cocktail insert successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cocktail_category_id' => 'required',
            'subtitle'             => 'required',
            'title'                => 'required',

        ], [
            'cocktail_category_id.required' => 'The category is required.',
            'subtitle.required'             => 'The subtitle is required.',
            'title.required'                => 'The title is required.',
        ]);

        if ($validator->fails()) {
            return send_error($validator->errors()->first());
        }
        $oldData = Cocktail::find($request->id);
        $data = $request->except('id');
        try {
            $data['updated_by'] = Auth::user()->id;
            $data['updated_at'] = Carbon::now();
            $data['last_update_ip'] = request()->ip();
            $oldData->update($data);

            return response()->json("Cocktail update successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Cocktail::find($request->id);
            $data->delete();
            return response()->json("Cocktail delete successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blog = Blog::where('status', 'a')->with('category')->latest()->get();
        return response()->json($blog);

    }
    public function getCategories()
    {
        $blog = BlogCategory::latest()->get();
        return response()->json($blog);

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
            BlogCategory::create($data);
            return response()->json("Category inserted successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function create()
    {
        // if (!checkAccess('specialtie')) {
        //     return view('error.unauthorize');
        // }

        return view('administration.website.blog');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'date'        => 'required',
            'description' => 'required',
            'image'       => 'required|image',
            
        ], [
            'title.required'       => 'The title is required.',
            'date.required'        => 'The price is required.',
            'description.required' => 'The description is required.',
            'image.required'       => 'The image is required.',
            
        ]);        

        if ($validator->fails()) {
            return send_error($validator->errors()->first());
        }
        $data = $request->except('image', 'id');
        $data['slug'] = Str::slug($request->title);
        try {
            if ($request->hasFile('image')) {
                $data['image'] = imageUpload($request, 'image', 'uploads/blog', uniqid());
            }
            $data['added_by'] = Auth::user()->id;
            $data['last_update_ip'] = request()->ip();
            Blog::create($data);
            return response()->json("Blog insert successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'description' => 'required',
            
        ], [
            'title.required' => 'The title is required.',
            'date.required' => 'The date is required.',
            'description.required' => 'The description is required.',
        ]);        

        if ($validator->fails()) {
            return send_error($validator->errors()->first());
        }
        $oldData = Blog::find($request->id);
        $data = $request->except('image', 'id');
        $data['slug'] = Str::slug($request->title);
        try {
            $data['image'] = $oldData->image;
            if ($request->hasFile('image')) {
                if (File::exists($oldData->image)) {
                    File::delete($oldData->image);
                }
                $data['image'] = imageUpload($request, 'image', 'uploads/blog', uniqid());
            }
            $data['updated_at'] = Carbon::now();
            $oldData->update($data);

            return response()->json("Blog update successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Blog::find($request->id);
            if (File::exists($data->image)) {
                File::delete($data->image);
                $data->image = null;
            }
            $data->status = 'd';
            $data->update();

            $data->delete();
            return response()->json("Blog delete successfully");
        } catch (\Throwable $th) {
            return send_error("Something went wrong", $th->getMessage());
        }
    }

}

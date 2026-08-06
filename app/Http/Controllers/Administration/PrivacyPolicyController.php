<?php
namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        if (!checkAccess('privacy')) {
            return view('error.unauthorize');
        }
        return view('administration.website.privacy_policy');
    }

    public function getPrivacies() 
    {
        $privacyPolicies = PrivacyPolicy::latest()->get();
        return response()->json($privacyPolicies);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $privacy = new PrivacyPolicy();
        $privacy->title = $validated['title'];
        $privacy->description = $validated['description'];
        $privacy->save();

        return response()->json('Privacy Policy created successfully!');
    }

    public function edit($id)
    {
        $privacy = PrivacyPolicy::find($id);
        return response()->json($privacy);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $privacy = PrivacyPolicy::find($id);
        if ($privacy) {
            $privacy->title = $validated['title'];
            $privacy->description = $validated['description'];
            $privacy->save();

            return response()->json('Privacy Policy updated successfully!');
        }

        return response()->json('Privacy Policy not found!', 404);
    }

    public function destroy($id)
    {
        $privacy = PrivacyPolicy::find($id);
        if ($privacy) {
            $privacy->delete();
            return response()->json('Privacy Policy deleted successfully!');
        }
        return response()->json('Privacy Policy not found!', 404);
    }
}

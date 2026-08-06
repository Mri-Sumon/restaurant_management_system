<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        if (!checkAccess('privacy')) {
            return view('error.unauthorize');
        }
        return view('administration.website.terms_and_onditions');
    }

    public function getTerms()
    {
        $termsAndConditions = TermsAndCondition::latest()->get();
        return response()->json($termsAndConditions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $term = new TermsAndCondition();
        $term->title = $validated['title'];
        $term->description = $validated['description'];
        $term->save();

        return response()->json('Term created successfully!');
    }

    public function edit($id)
    {
        $term = TermsAndCondition::find($id);
        return response()->json($term);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $term = TermsAndCondition::find($id);
        if ($term) {
            $term->title = $validated['title'];
            $term->description = $validated['description'];
            $term->save();

            return response()->json('Term updated successfully!');
        }

        return response()->json('Term not found!', 404);
    }

    public function destroy($id)
    {
        $term = TermsAndCondition::find($id);
        if ($term) {
            $term->delete();
            return response()->json('Term deleted successfully!');
        }
        return response()->json('Term not found!', 404);
    }
}

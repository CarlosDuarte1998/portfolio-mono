<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required||max:255||string',
            'description' => 'required',
            'start_date' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //images upload

        if ($request->hasFile('image')) {
           $imagePath = $request->file('image')->store('images', 'public');
        }else{
            $imagePath = null;
        }

        $project = new Project([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'image' => $imagePath,
        ]);

        $project->save();

        return response()->json($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

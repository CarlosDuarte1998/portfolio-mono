<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;


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

        return inertia('projects', [
            'projects' => Project::all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        //
        $project = Project::find($id);
        return response()->json($project);
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

    public function edit(Request $request)
    {
        $projectId = $request->input('id');
        $response = Http::get(route('projects.show', $projectId));
        $projectData = $response->json();
        $hasRecords = !empty($projectData);
        if ($hasRecords) {
            return Inertia::render('Projects/Edit', [
                'project' => [
                    'hasRecords' => $hasRecords,
                    'id' => $projectId,
                    'data' => $projectData,
                ]
            ]);
        } else {
            return Inertia::render('Projects/Edit', [
                'project' => [
                    'hasRecords' => $hasRecords,
                    'id' => $projectId,
                    'data' => [],
                ]
            ]);
        }

    }
}

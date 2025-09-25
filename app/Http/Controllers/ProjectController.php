<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|min:3',
            'description' => 'max:255',
        ]);
        Project::create($validated);

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'max:255',
        ]);
        $project->update(['name' => $request['name']]);
        $project->save();

        return redirect(route('projects.show'), $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect(route('projects.index'));
    }
}

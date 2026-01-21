<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\ActivitySector;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('client','sector')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $sectors = ActivitySector::orderBy('name')->get();
        return view('admin.projects.create', compact('clients','sectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug'  => 'required|unique:projects,slug',
        ]);

        Project::create($request->all());

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $clients = Client::orderBy('name')->get();
        $sectors = ActivitySector::orderBy('name')->get();
        return view('admin.projects.edit', compact('project','clients','sectors'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'slug'  => 'required|unique:projects,slug,'.$project->id,
        ]);

        $project->update($request->all());

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}

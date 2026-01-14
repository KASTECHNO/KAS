<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
                         ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
                         ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
                         ->with('success', 'Project deleted successfully.');
    }
}

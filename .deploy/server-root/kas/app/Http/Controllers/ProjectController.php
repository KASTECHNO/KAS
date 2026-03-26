<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use  App\Models\Project;
use  App\Models\Client;
use  App\Models\ActivitySector;
use App\Services\KpiMetricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'main_image_file' => 'nullable|image|max:6144',
        ]);

        $payload = $request->except('main_image_file');

        if ($request->hasFile('main_image_file')) {
            $payload['main_image_path'] = $request->file('main_image_file')->store('projects/main', 'public');
            $payload['main_image_url'] = Storage::disk('public')->url($payload['main_image_path']);
        }

        Project::create($payload);
        app(KpiMetricService::class)->recalculate();

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
            'main_image_file' => 'nullable|image|max:6144',
        ]);

        $payload = $request->except('main_image_file');

        if ($request->hasFile('main_image_file')) {
            $payload['main_image_path'] = $request->file('main_image_file')->store('projects/main', 'public');
            $payload['main_image_url'] = Storage::disk('public')->url($payload['main_image_path']);
        }

        $project->update($payload);
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        return $this->delete($project);
    }

    public function delete(Project $project)
    {
        $project->delete();
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}

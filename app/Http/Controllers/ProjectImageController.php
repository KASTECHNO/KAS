<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\ProjectImage;
use App\Project;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    public function index()
    {
        $images = ProjectImage::with('project')->orderBy('project_id')->orderBy('display_order')->get();
        return view('admin.project_images.index', compact('images'));
    }

    public function create()
    {
        $projects = Project::orderBy('title')->get();
        return view('admin.project_images.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'image_url'  => 'required',
        ]);

        ProjectImage::create($request->all());

        return redirect()->route('admin.project-images.index')
            ->with('success', 'Project image created successfully.');
    }

    public function edit(ProjectImage $project_image)
    {
        $projects = Project::orderBy('title')->get();
        return view('admin.project_images.edit', [
            'image'    => $project_image,
            'projects' => $projects,
        ]);
    }

    public function update(Request $request, ProjectImage $project_image)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'image_url'  => 'required',
        ]);

        $project_image->update($request->all());

        return redirect()->route('admin.project-images.index')
            ->with('success', 'Project image updated successfully.');
    }

    public function delete(ProjectImage $project_image)
    {
        $project_image->delete();

        return redirect()->route('admin.project-images.index')
            ->with('success', 'Project image deleted successfully.');
    }
}

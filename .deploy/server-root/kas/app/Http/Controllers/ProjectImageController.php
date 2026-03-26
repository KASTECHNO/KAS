<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use  App\Models\ProjectImage;
use  App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image_url'  => 'nullable',
            'image_file' => 'nullable|image|max:6144',
        ]);

        $payload = $request->except('image_file');

        if ($request->hasFile('image_file')) {
            $payload['image_path'] = $request->file('image_file')->store('projects/gallery', 'public');
            $payload['image_url'] = Storage::disk('public')->url($payload['image_path']);
        }

        if (empty($payload['image_url'])) {
            return back()->withErrors(['image_url' => 'Image URL or image file is required.'])->withInput();
        }

        ProjectImage::create($payload);

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
            'image_url'  => 'nullable',
            'image_file' => 'nullable|image|max:6144',
        ]);

        $payload = $request->except('image_file');

        if ($request->hasFile('image_file')) {
            $payload['image_path'] = $request->file('image_file')->store('projects/gallery', 'public');
            $payload['image_url'] = Storage::disk('public')->url($payload['image_path']);
        }

        if (empty($payload['image_url'])) {
            return back()->withErrors(['image_url' => 'Image URL or image file is required.'])->withInput();
        }

        $project_image->update($payload);

        return redirect()->route('admin.project-images.index')
            ->with('success', 'Project image updated successfully.');
    }

    public function destroy(ProjectImage $project_image)
    {
        return $this->delete($project_image);
    }

    public function delete(ProjectImage $project_image)
    {
        $project_image->delete();

        return redirect()->route('admin.project-images.index')
            ->with('success', 'Project image deleted successfully.');
    }
}

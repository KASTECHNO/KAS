<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use  App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function submitFromWebsite(Request $request)
    {
        $payload = $request->validate([
            'client_name' => 'required|string|max:150',
            'client_role' => 'nullable|string|max:150',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|max:3000',
        ]);

        $payload['is_active'] = false;
        $payload['display_order'] = 0;

        Testimonial::create($payload);

        return redirect()->route('home')->with('testimonial_success', 'Merci. Votre temoignage a ete recu et sera publie apres validation de notre equipe.');
    }

    public function index()
    {
        $testimonials = Testimonial::orderBy('display_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'message'     => 'required',
            'avatar_file' => 'nullable|image|max:4096',
        ]);

        $payload = $request->except('avatar_file');

        if ($request->hasFile('avatar_file')) {
            $payload['avatar_path'] = $request->file('avatar_file')->store('testimonials', 'public');
            $payload['avatar_url'] = Storage::disk('public')->url($payload['avatar_path']);
        }

        Testimonial::create($payload);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'client_name' => 'required',
            'message'     => 'required',
            'avatar_file' => 'nullable|image|max:4096',
        ]);

        $payload = $request->except('avatar_file');

        if ($request->hasFile('avatar_file')) {
            $payload['avatar_path'] = $request->file('avatar_file')->store('testimonials', 'public');
            $payload['avatar_url'] = Storage::disk('public')->url($payload['avatar_path']);
        }

        $testimonial->update($payload);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        return $this->delete($testimonial);
    }

    public function delete(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}

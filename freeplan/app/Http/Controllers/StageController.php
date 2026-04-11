<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::latest()->get();
        return view('admin.stages.index', compact('stages'));
    }

    public function create()
    {
        return view('admin.stages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'         => 'required|string|max:200',
            'domaine'       => 'required|string|max:100',
            'type_stage'    => 'required|string|max:50',
            'niveau_requis' => 'nullable|string|max:100',
            'description'   => 'required|string',
            'technologies'  => 'nullable|string',
            'date_limite'   => 'nullable|date',
            'is_active'     => 'boolean',
        ]);

        $data['slug']      = Str::slug($data['titre']) . '-' . Str::random(5);
        $data['is_active'] = $request->boolean('is_active');

        Stage::create($data);

        return redirect()->route('admin.stages.index')->with('success', 'Offre de stage créée avec succès.');
    }

    public function edit(Stage $stage)
    {
        return view('admin.stages.edit', compact('stage'));
    }

    public function update(Request $request, Stage $stage)
    {
        $data = $request->validate([
            'titre'         => 'required|string|max:200',
            'domaine'       => 'required|string|max:100',
            'type_stage'    => 'required|string|max:50',
            'niveau_requis' => 'nullable|string|max:100',
            'description'   => 'required|string',
            'technologies'  => 'nullable|string',
            'date_limite'   => 'nullable|date',
            'is_active'     => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $stage->update($data);

        return redirect()->route('admin.stages.index')->with('success', 'Offre de stage mise à jour.');
    }

    public function destroy(Stage $stage)
    {
        $stage->delete();
        return redirect()->route('admin.stages.index')->with('success', 'Offre de stage supprimée.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\StageCandidature;
use Illuminate\Http\Request;

class StageCandidatureController extends Controller
{
    // ── Public: postuler à une offre ───────────────────────────────────────────

    public function store(Request $request, Stage $stage)
    {
        $data = $request->validate([
            'nom'               => 'required|string|max:150',
            'email'             => 'required|email|max:255',
            'phone'             => 'nullable|string|max:50',
            'etablissement'     => 'nullable|string|max:200',
            'niveau_etudes'     => 'nullable|string|max:100',
            'specialite'        => 'nullable|string|max:150',
            'lettre_motivation' => 'nullable|string',
            'cv'                => 'nullable|file|mimes:pdf,doc,docx|max:4096',
        ]);

        if ($request->hasFile('cv')) {
            $data['cv_path'] = $request->file('cv')->store('candidatures/cvs', 'public');
        }

        $data['stage_id'] = $stage->id;
        $data['statut']   = 'RECU';
        unset($data['cv']);

        StageCandidature::create($data);

        return back()->with('success', 'Votre candidature a bien été envoyée. Nous vous contacterons bientôt !');
    }

    // ── Admin: liste des candidatures ──────────────────────────────────────────

    public function index(Request $request)
    {
        $query = StageCandidature::with('stage')->latest();

        if ($request->filled('stage_id')) {
            $query->where('stage_id', $request->stage_id);
        }
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $candidatures = $query->paginate(20);
        $stages       = Stage::orderBy('titre')->get();

        return view('admin.candidatures.index', compact('candidatures', 'stages'));
    }

    public function show(StageCandidature $candidature)
    {
        return view('admin.candidatures.show', compact('candidature'));
    }

    public function update(Request $request, StageCandidature $candidature)
    {
        $data = $request->validate([
            'statut'      => 'required|in:RECU,EN_COURS,ACCEPTE,REFUSE',
            'notes_admin' => 'nullable|string',
        ]);

        $candidature->update($data);

        return back()->with('success', 'Statut de la candidature mis à jour.');
    }

    public function destroy(StageCandidature $candidature)
    {
        $candidature->delete();
        return redirect()->route('admin.candidatures.index')->with('success', 'Candidature supprimée.');
    }
}

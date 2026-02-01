<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Quote;
use App\Service;
use App\Project;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    // Liste de tous les devis
    public function index()
    {
        $quotes = Quote::with('service', 'project')->latest()->get();
        return view('admin.quotes.index', compact('quotes'));
    }

    // Formulaire pour créer un nouveau devis
    public function create()
    {
        $services = Service::all();
        $projects = Project::all();
        return view('admin.quotes.create', compact('services', 'projects'));
    }

    // Enregistrer un nouveau devis
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        Quote::create($request->all());

        return redirect()->route('admin.quotes.index')->with('success', 'Devis créé avec succès !');
    }

    // Afficher un devis
    public function show(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    // Formulaire pour éditer un devis
    public function edit(Quote $quote)
    {
        $services = Service::all();
        $projects = Project::all();
        return view('admin.quotes.edit', compact('quote', 'services', 'projects'));
    }

    // Mettre à jour un devis
    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            'fullname' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
            'project_id' => 'required|exists:projects,id',
            'status' => 'required|in:NEW,IN_PROGRESS,SENT,ACCEPTED,REJECTED',
        ]);

        $quote->update($request->all());

        return redirect()->route('admin.quotes.index')->with('success', 'Devis mis à jour avec succès !');
    }

    // Supprimer un devis
    public function delete(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('admin.quotes.index')->with('success', 'Devis supprimé avec succès !');
    }
}


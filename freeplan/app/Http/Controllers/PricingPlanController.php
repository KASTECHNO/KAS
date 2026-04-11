<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::orderByRaw("FIELD(type,'mensuel','annuel','licence')")->get();
        return view('admin.pricing.index', compact('plans'));
    }

    public function create()
    {
        // Types déjà utilisés → on ne peut créer que les types manquants
        $usedTypes = PricingPlan::pluck('type')->toArray();
        $availableTypes = array_diff(['mensuel', 'annuel', 'licence'], $usedTypes);
        return view('admin.pricing.create', compact('availableTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'           => 'required|in:mensuel,annuel,licence|unique:pricing_plans,type',
            'prix'           => 'required|numeric|min:0',
            'nom_application'=> 'nullable|string|max:200',
            'description'    => 'nullable|string',
            'fonctionnalites'=> 'nullable|string',
            'badge'          => 'nullable|string|max:80',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'display_order'  => 'nullable|integer|min:0',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');

        PricingPlan::create($data);

        return redirect()->route('admin.pricing.index')->with('success', 'Offre tarifaire créée avec succès.');
    }

    public function edit(PricingPlan $pricing)
    {
        return view('admin.pricing.edit', compact('pricing'));
    }

    public function update(Request $request, PricingPlan $pricing)
    {
        $data = $request->validate([
            'type'           => 'required|in:mensuel,annuel,licence|unique:pricing_plans,type,' . $pricing->id,
            'prix'           => 'required|numeric|min:0',
            'nom_application'=> 'nullable|string|max:200',
            'description'    => 'nullable|string',
            'fonctionnalites'=> 'nullable|string',
            'badge'          => 'nullable|string|max:80',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'display_order'  => 'nullable|integer|min:0',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');

        $pricing->update($data);

        return redirect()->route('admin.pricing.index')->with('success', 'Offre tarifaire mise à jour.');
    }

    public function destroy(PricingPlan $pricing)
    {
        $pricing->delete();
        return redirect()->route('admin.pricing.index')->with('success', 'Offre tarifaire supprimée.');
    }
}


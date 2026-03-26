<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ActivitySector;
use App\Services\KpiMetricService;
use Illuminate\Http\Request;

class ActivitySectorController extends Controller
{
    public function index()
    {
        $sectors = ActivitySector::orderBy('display_order')->get();
        return view('admin.sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('admin.sectors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        ActivitySector::create($request->all());
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.sectors.index')
            ->with('success', 'Sector created successfully.');
    }

    public function edit(ActivitySector $sector)
    {
        return view('admin.sectors.edit', compact('sector'));
    }

    public function update(Request $request, ActivitySector $sector)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $sector->update($request->all());
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.sectors.index')
            ->with('success', 'Sector updated successfully.');
    }

    public function destroy(ActivitySector $sector)
    {
        return $this->delete($sector);
    }

    public function delete(ActivitySector $sector)
    {
        $sector->delete();
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.sectors.index')
            ->with('success', 'Sector deleted successfully.');
    }
}

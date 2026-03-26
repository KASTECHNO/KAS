<?php

namespace App\Http\Controllers;

use App\Models\KpiMetric;
use App\Services\KpiMetricService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KpiMetricController extends Controller
{
    public function index(): View
    {
        $kpis = KpiMetric::query()->orderBy('display_order')->get();

        return view('admin.kpis.index', compact('kpis'));
    }

    public function edit(KpiMetric $kpi): View
    {
        return view('admin.kpis.edit', compact('kpi'));
    }

    public function update(Request $request, KpiMetric $kpi): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string', 'max:500'],
            'display_order' => ['nullable', 'integer', 'min:1', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $kpi->update([
            'title' => $validated['title'],
            'unit' => $validated['unit'] ?? null,
            'description' => $validated['description'] ?? null,
            'display_order' => $validated['display_order'] ?? $kpi->display_order,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.kpis.index')->with('success', 'KPI mis a jour.');
    }

    public function recalculate(KpiMetricService $service): RedirectResponse
    {
        $service->recalculate();

        return redirect()->route('admin.kpis.index')->with('success', 'KPI recalcules avec succes.');
    }
}

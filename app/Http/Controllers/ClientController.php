<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use  App\Models\Client;
use  App\Models\ActivitySector;
use App\Services\KpiMetricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('sector')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $sectors = ActivitySector::orderBy('name')->get();
        return view('admin.clients.create', compact('sectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo_file' => 'nullable|image|max:4096',
        ]);

        $payload = $request->except('logo_file');

        if ($request->hasFile('logo_file')) {
            $payload['logo_path'] = $request->file('logo_file')->store('clients', 'public');
            $payload['logo_url'] = Storage::disk('public')->url($payload['logo_path']);
        }

        Client::create($payload);
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        $sectors = ActivitySector::orderBy('name')->get();
        return view('admin.clients.edit', compact('client', 'sectors'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'logo_file' => 'nullable|image|max:4096',
        ]);

        $payload = $request->except('logo_file');

        if ($request->hasFile('logo_file')) {
            $payload['logo_path'] = $request->file('logo_file')->store('clients', 'public');
            $payload['logo_url'] = Storage::disk('public')->url($payload['logo_path']);
        }

        $client->update($payload);
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        return $this->delete($client);
    }

    public function delete(Client $client)
    {
        $client->delete();
        app(KpiMetricService::class)->recalculate();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}

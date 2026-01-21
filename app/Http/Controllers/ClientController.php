<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ActivitySector;
use Illuminate\Http\Request;

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
        ]);

        Client::create($request->all());

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
        ]);

        $client->update($request->all());

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}

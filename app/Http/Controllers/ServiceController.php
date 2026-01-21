<?php
use App\Models\Service;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('display_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug'  => 'required|unique:services,slug',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
            'slug'  => 'required|unique:services,slug,'.$service->id,
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}

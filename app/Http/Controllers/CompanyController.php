<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use  App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::first();
        return view('admin.company.index', compact('company'));
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo_file' => 'nullable|image|max:4096',
        ]);

        $payload = $request->except('logo_file');

        if ($request->hasFile('logo_file')) {
            $payload['logo_path'] = $request->file('logo_file')->store('company', 'public');
            $payload['logo_url'] = Storage::disk('public')->url($payload['logo_path']);
        }

        Company::create($payload);

        return redirect()->route('admin.company.index')
            ->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'logo_file' => 'nullable|image|max:4096',
        ]);

        $payload = $request->except('logo_file');

        if ($request->hasFile('logo_file')) {
            $payload['logo_path'] = $request->file('logo_file')->store('company', 'public');
            $payload['logo_url'] = Storage::disk('public')->url($payload['logo_path']);
        }

        $company->update($payload);

        return redirect()->route('admin.company.index')
            ->with('success', 'Company updated successfully.');
    }
}

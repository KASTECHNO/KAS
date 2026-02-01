<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::first();
        return view('admin.company.index', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company->update($request->all());

        return redirect()->route('admin.company.index')
            ->with('success', 'Company updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'location' => 'nullable|string',
            'industry' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company_logos', 'public.images');
        }

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'location' => $request->location,
            'industry' => $request->industry,
            'logo' => $logoPath,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'location' => 'nullable|string',
            'industry' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = $company->logo;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company_logos', 'public');
        }

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'location' => $request->location,
            'industry' => $request->industry,
            'logo' => $logoPath,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}

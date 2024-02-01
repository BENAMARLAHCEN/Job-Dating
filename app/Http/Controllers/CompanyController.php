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
        $companies = Company::latest()->paginate(6);
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $logoName = time().'.'.$request->logo->extension();  
         
        $request->logo->move(public_path('logo'), $logoName);
    


        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'location' => $request->location,
            'industry' => $request->industry,
            'logo' => $logoName,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully')->with('image', $logoName); ;
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logoName = time().'.'.$request->logo->extension();  
         
        $request->logo->move(public_path('logo'), $logoName);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'location' => $request->location,
            'industry' => $request->industry,
            'logo' => $logoName,
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

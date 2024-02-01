<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Company;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->with('company')->paginate(6);
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('admin.announcements.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'skills' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
            'company_id' => 'required|exists:companies,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads'), $imageName);

        Announcement::create([
            'title' => $request->title,
            'skills' => $request->skills,
            'description' => $request->description,
            'date' => $request->date,
            'company_id' => $request->company_id,
            'image' => $imageName,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        $announcement->load('company');
        return view('admin.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        $companies = Company::all();
        return view('admin.announcements.edit', compact('announcement', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required',
            'skills' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
            'company_id' => 'required|exists:companies,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads'), $imageName);

        $announcement->update([
            'title' => $request->title,
            'skills' => $request->skills,
            'description' => $request->description,
            'date' => $request->date,
            'company_id' => $request->company_id,
            'image' => $imageName,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully');
    }
}

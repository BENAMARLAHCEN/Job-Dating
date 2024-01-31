<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::all();
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
            'description' => 'nullable',
            'date' => 'required|date',
            'company_id' => 'required|exists:companies,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcements_images', 'public');
        }

        Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'company_id' => $request->company_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
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
            'description' => 'nullable',
            'date' => 'required|date',
            'company_id' => 'required|exists:companies,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
        ]);

        $imagePath = $announcement->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcements_images', 'public');
        }

        $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'company_id' => $request->company_id,
            'image' => $imagePath,
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

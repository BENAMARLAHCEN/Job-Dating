<?php

namespace App\Http\Controllers;

use App\Models\AnnounceCompany;
use App\Models\Announcement;
use App\Models\Company;
use App\Models\Skill;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->with('company','skill','attendances')->paginate(6);
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $skills = Skill::all();
        return view('admin.announcements.create', compact('companies', 'skills'));
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
            'company_ids' => 'required|array',
            'company_ids.*' => 'exists:companies,id',
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $imageName = time() . '.' . $request->image->extension();

        $announcement = Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'image' => $imageName,
        ]);

        $request->image->move(public_path('uploads'), $imageName);

        $announcement->company()->attach($request->company_ids);

        if ($request->has('skill_ids')) {
            $announcement->skill()->attach($request->skill_ids);
        }

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        $announcement->load('company')->load('skill');
        return view('admin.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        $companies = Company::all();
        $skills = Skill::all();
        return view('admin.announcements.edit', compact('announcement', 'companies', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'company_ids' => 'required|array',
            'company_ids.*' => 'exists:companies,id',
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        if ($request->hasFile('image')) {
            if ($announcement->image) {
                unlink(public_path('uploads/' . $announcement->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $announcement->update(['image' => $imageName]);
        }


        $announcement->company()->sync($request->company_ids);


        if ($request->has('skill_ids')) {
            $announcement->skill()->sync($request->skill_ids);
        } else {
            $announcement->skill()->detach();
        }

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

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::get();
        $user = User::find(auth()->id());
        $announcements = Announcement::whereHas('attendances', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(10);

        return view('profile.index', compact('user', 'announcements', 'skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $skills = Skill::get();
        $user = User::find(auth()->id());
        $announcements = Announcement::whereHas('attendances', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(10);

        return view('profile.edit', compact('user', 'announcements', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'mobile' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'bio' => 'nullable|string',
        ]);

        // Update the user's name
        $user->name = $request->name;

        // Update the user's profile
        $profile = $user->profile;
        $profile->birthday = $request->birthday;
        $profile->mobile = $request->mobile;
        $profile->location = $request->location;
        $profile->job = $request->job;
        $profile->address = $request->address;
        $profile->linkedin = $request->linkedin;
        $profile->github = $request->github;
        $profile->facebook = $request->facebook;
        $profile->instagram = $request->instagram;
        $profile->bio = $request->bio;

        // Save the changes
        $user->save();
        $profile->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    
}

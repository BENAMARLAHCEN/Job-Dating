<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(6);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $skills = Skill::all(); 
        return view('admin.users.create', compact('roles', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => ['required', Rule::in(Role::pluck('name')->toArray())],
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
        ]);
        Profile::create([
            'user_id' => $user->id,
        ]);

        $request->image->move(public_path('images'), $imageName);


        $role = $request->input('role');
        $user->assignRole($role);

        $skills = $request->input('skills');
        $user->skills()->sync($skills);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $skills = Skill::all(); 
        return view('admin.users.edit', compact('user', 'roles', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
            'role' => ['required', Rule::in(Role::pluck('name')->toArray())],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $role = $request->input('role');
        $user->syncRoles([$role]);

        // Sync skills...
        $skills = $request->input('skills');
        $user->skills()->sync($skills);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            if ($user->image && $user->image !== 'recherche-job.webp') {
                unlink(public_path('images/' . $user->image));
            }

            $user->update(['image' => $imageName]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.index')->with('success', 'Password updated successfully.');
    }
}

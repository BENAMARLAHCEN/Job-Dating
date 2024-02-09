<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class UserSkillsController extends Controller
{
    public function deleteSkill(Skill $skill)
    {
        $user = User::find(auth()->id());
        if ($user->skills->contains($skill)) {
            $user->skills()->detach($skill);
            return redirect()->back()->with('success', 'Skill deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Skill not found');
        }
    }

    public function storeSkills(Request $request)
    {
        $request->validate([
            'new_skills' => 'required|array', // Ensure an array of skill IDs is submitted
            'new_skills.*' => 'exists:skills,id', // Validate each skill ID exists in the skills table
        ]);

        // Find the authenticated user
        $user = User::find(auth()->id());
        // Attach the selected new skills to the user
        $user->skills()->attach($request->new_skills);

        return redirect()->back()->with('success', 'Skills added successfully');
    }
}

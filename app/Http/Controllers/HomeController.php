<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $announcements = Announcement::with('company', 'skills')->latest()->filter(request(['skill', 'search']))->paginate(6);
        if (auth()) {
            // Calculate matching percentage for each announcement
            foreach ($announcements as $announcement) {
                $announcementSkills = $announcement->skills->pluck('id')->toArray();
                $userSkills = auth()->user()->skills->pluck('id')->toArray();

                // Calculate intersection of skills
                $matchingSkills = array_intersect($announcementSkills, $userSkills);

                // Calculate matching percentage
                if (count($matchingSkills) != 0) {

                    $matchingPercentage = count($matchingSkills) / count($announcementSkills) * 100;
                }else {
                    $matchingPercentage = 0;
                }
                // Assign matching percentage to the announcement
                $announcement->matchingPercentage = $matchingPercentage;
            }
        }
        return view('index', compact('announcements'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {

        $announcements = Announcement::with('company', 'skills')->latest()->filter(request(['skill', 'search']))->paginate(6);
        if (auth()->check()) {

            foreach ($announcements as $announcement) {
                $announcementSkills = $announcement->skills->pluck('id')->toArray();
                $userSkills = auth()->user()->skills->pluck('id')->toArray();

                $matchingSkills = array_intersect($announcementSkills, $userSkills);


                if (count($matchingSkills) != 0) {

                    $matchingPercentage = count($matchingSkills) / count($announcementSkills) * 100;
                }else {
                    $matchingPercentage = 0;
                }

                $announcement->matchingPercentage = $matchingPercentage;
            }
        }
        return view('index', compact('announcements'));
    }
}

<?php

namespace App\Http\Controllers\Dachboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $numUsers = User::count();
        $numAnnouncements = Announcement::count();
        $numCompanies = Company::count();
        $numAttendance = Attendance::count();

        // Get top announcements with attendance (replace with actual query)
        $topAnnouncements = Announcement::withCount('attendances')->orderBy('attendances_count', 'desc')->take(5)->get();
        return view('admin.dashboard.statistic',compact('numUsers','numAnnouncements','numCompanies','numAttendance','topAnnouncements'));
    }
}

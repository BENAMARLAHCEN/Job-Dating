<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function recordAttendance(Request $request, Announcement $announcement)
    {
        
        $this->validateJobInterviewDay($announcement);
        
        Attendance::create([
            'user_id' => auth()->id(),
            'announcement_id' => $announcement->id,
        ]);

        return redirect()->back()->with('success', 'Attendance recorded successfully');
    }


    public function unrecordAttendance(Request $request, Announcement $announcement)
    {
        $announcement->unrecordAttendance(auth()->id());

        return redirect()->back()->with('success', 'Attendance unrecorded successfully');
    }

    protected function validateJobInterviewDay(Announcement $announcement)
    {
        $announcementDate = $announcement->date;

        if ($announcementDate < now()->toDateString()) {
            abort(403, 'Job interview day has already passed.');
        }

        if ($announcement->attendances()->where('user_id', auth()->id())->exists()) {
            abort(403, 'Attendance already recorded for this announcement.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::latest()->with('user','announcement')->filter(request(['announce']))->paginate(6);
        return view('admin.attendances.index', compact('attendances'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->back()->with('success', 'attendance deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $announcements = Announcement::with('company','skills')->latest()->filter(request(['skill', 'search']))->paginate(6);
        return view('index', compact('announcements'));
    }
}

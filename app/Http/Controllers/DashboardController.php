<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Guardian;
use App\Models\PickupLog;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // get counts of students where the status is active
        $studentsCount = Student::where('status', 'active')->count();

        // get the count of guardians where the student status is active
        $guardiansCount = Guardian::whereHas('student', function ($query) {
            $query->where('status', 'active');
        })->count();

        // get the count of grades
        $gradesCount = Grade::count();

        // get the count of users
        $usersCount = User::count();

        // get all pickup logs sorted by latest and maximum of 10
        $pickupLogs = PickupLog::latest()->take(10)->get();

        // return the view with the counts
        return view('pages.dashboard.index', compact('studentsCount', 'guardiansCount', 'gradesCount', 'pickupLogs', 'usersCount'));
    }
}

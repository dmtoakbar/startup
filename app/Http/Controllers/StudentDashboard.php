<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboard extends Controller
{
    public function dashboard(Request $req) {
        return view('student_user.dashboard.dashboard');
    }
}

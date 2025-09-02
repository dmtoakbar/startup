<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\Studentuser;

class OfficeStudentController extends Controller
{
    function index(Request $req) {
        $students = Studentuser::all()->sortByDesc("created_at");
        return view('office_admin.student_user.student_user', compact('students'));
    }

    function changeStatus(Request $req) {

        if($req->isMethod('POST')) {
            $email = Crypt::decrypt($req->email);
            $status = $req->status_change;
            $result = Studentuser::where('email', $email)->update(['user_status' => $status]);
            if($result) {
                return redirect()->route('office-student')->with('success', 'User status updated successfully..!');
                exit();
            } else {
                return redirect()->route('office-student')->with('failed', 'Something went wrong, Please try again..!');
                exit();
            } 
        }

        $email = $req->email;
        return view('office_admin.student_user.change_student_status', compact('email'));
    }

    function showUserDetail(Request $req) {
        $detail = Crypt::decrypt($req->detail);
        return view('office_admin.student_user.show_user_detail', compact('detail'));
        exit();
    }
}

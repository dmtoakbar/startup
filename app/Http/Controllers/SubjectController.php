<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Crypt;

class SubjectController extends Controller
{
    function index()
    {
        $subject = Subject::all()->sortByDesc('id');
        return view('office_admin.online_test.subject.subject', compact('subject'));
    }
    // add test
    function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Subject::where('name', trim($req->subjectName))->get();
            if (count($check) <= 0) {
                $subject = new Subject();
                $subject->name = $req->subjectName;
                $saving_status = $subject->save();
                if ($saving_status) {
                    Session::flash('success', 'Subject add successfully...');
                    return redirect()->route('office-subjects');
                    exit();
                } else {
                    Session::flash('failed', 'Subject adding failed...');
                    return redirect()->route('office-subjects');
                    exit();
                }
            } else {
                Session::flash('warning', 'This subject already exist...');
                return redirect()->route('office-subjects');
                exit();
            }
        } else {
            return view('office_admin.online_test.subject.subject-add');
        }
    }
    // edit
    function edit(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Subject::where('name', trim($req->subjectName))->get();
            if (count($check) <= 0) {
                $subject = Subject::findOrFail($req->id);
                $subject->name = $req->subjectName;
                $saving_status = $subject->save();
                if ($saving_status) {
                    Session::flash('success', 'Subject updated successfully...');
                    return redirect()->route('office-subjects');
                    exit();
                } else {
                    Session::flash('failed', 'Subject updation failed...');
                    return redirect()->route('office-subjects');
                    exit();
                }
            } else {
                Session::flash('warning', 'This subject already exist...');
                return redirect()->route('office-subjects');
                exit();
            }
        } else {
            $subject = Subject::findOrFail($req->id);
            return view('office_admin.online_test.subject.subject-edit', compact('subject'));
        }
    }
     // delete subject
     function delete(Request $req)
    {
        $subject = Subject::findOrFail($req->id)->delete();
        if ($subject) {
            Session::flash('success', 'Subject delete successfully...');
            return redirect()->route('office-subjects');
            exit();
        } else {
            Session::flash('failed', 'Subject deletion failed...');
            return redirect()->route('office-subjects');
            exit();
        }
    }

    // change status
    function changeStatus(Request $req) {
        $subject = Subject::findOrFail($req->id);
        $subject->status = $req->status;
        $result = $subject->save();
        if ($result) {
            Session::flash('success', 'Subject status updated successfully...');
            return redirect()->route('office-subjects');
            exit();
        } else {
            Session::flash('failed', 'Subject status updation failed...');
            return redirect()->route('office-subjects');
            exit();
        }
    }
}

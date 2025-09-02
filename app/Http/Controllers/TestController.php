<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\File;
use App\Models\Questionpaper;
use App\Models\Questionpaperfront;

class TestController extends Controller
{
    function index()
    {
        $test = Test::all()->sortByDesc('id');
        return view('office_admin.online_test.test_name.test-name', compact('test'));
    }
    // add test
    function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Test::where('name', trim($req->testName))->get();
            if (count($check) <= 0) {
                $test = new Test();
                $test->name = $req->testName;
                $test->description = trim($req->description);
                if($req->hasfile('img'))
                {
                    $file = $req->file('img');
                    $extention = $file->getClientOriginalExtension();
                    $filename = 'test'.time().'.'.$extention;
                    $file->move('image/test/', $filename);
                    $test->img = $filename;
                }
                $saving_status = $test->save();
                if ($saving_status) {
                    Session::flash('success', 'Test add successfully...');
                    return redirect()->route('office-tests');
                    exit();
                } else {
                    Session::flash('failed', 'Test adding failed...');
                    return redirect()->route('office-tests');
                    exit();
                }
            } else {
                Session::flash('warning', 'This test already exist...');
                return redirect()->route('office-tests');
                exit();
            }
        } else {
            return view('office_admin.online_test.test_name.test-name-add');
        }
    }
    // edit
    function edit(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Test::where('name', trim($req->testName))
            ->where('id', '!=', $req->id)
            ->get();
            if (count($check) <= 0) {
                $test = Test::findOrFail($req->id);
                $test->name = $req->testName;
                $test->description = trim($req->description);
                if($req->hasfile('img'))
                {
                     
                    $destination = 'image/test/'.$test->img;
                    if(File::exists($destination))
                    {
                        File::delete($destination);
                    }

                    $file = $req->file('img');
                    $extention = $file->getClientOriginalExtension();
                    $filename = 'test'.time().'.'.$extention;
                    $file->move('image/test/', $filename);
                    $test->img = $filename;
                }
                $saving_status = $test->save();
                if ($saving_status) {
                    Session::flash('success', 'Test updated successfully...');
                    return redirect()->route('office-tests');
                    exit();
                } else {
                    Session::flash('failed', 'Test updation failed...');
                    return redirect()->route('office-tests');
                    exit();
                }
            } else {
                Session::flash('warning', 'This test already exist...');
                return redirect()->route('office-tests');
                exit();
            }
        } else {
            $test = Test::findOrFail($req->id);
            return view('office_admin.online_test.test_name.test-name-edit', compact('test'));
        }
    }
     // delete test
     function delete(Request $req)
    {   
        $test = Test::findOrFail($req->id);

        $destination = 'image/test/'.$test->img;
        if(File::exists($destination))
        {
            File::delete($destination);
        }

        $test_name = $test->name;
        $qf = Questionpaperfront::where('test_name', $test_name)->first();

        if($qf != null) {
            $id = $qf->id;
            $qf_status = Questionpaperfront::where('test_name', $test_name)->delete();
            $q_status = Questionpaper::where('questionpaperfronts_id', $id)->delete();
        } else {
            $qf_status = true;
            $q_status = true;
        }
        
        $result = $test->delete();

        if ($result & $qf_status & $q_status) {
            Session::flash('success', 'Test delete successfully...');
            return redirect()->route('office-tests');
            exit();
        } else {
            Session::flash('failed', 'Test deletion failed...');
            return redirect()->route('office-tests');
            exit();
        }
    }

    // change status
    function changeTestStatus(Request $req) {
        $test = Test::findOrFail($req->id);
        $test->status = $req->status;
        $result = $test->save();
        if ($result) {
            Session::flash('success', 'Test status updated successfully...');
            return redirect()->route('office-tests');
            exit();
        } else {
            Session::flash('failed', 'Test status updation failed...');
            return redirect()->route('office-tests');
            exit();
        }
    }
}

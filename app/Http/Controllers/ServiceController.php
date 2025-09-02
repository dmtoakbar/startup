<?php

namespace App\Http\Controllers;
use Session;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class ServiceController extends Controller
{
    // services page display
    function index()
    {
        $service = Service::all()->sortByDesc('id');
        return view('office_admin.services.services', compact('service'));
    }
    // add service
    function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Service::where('name', trim($req->serviceName))->get();
            if (count($check) <= 0) {
                $service = new Service();
                $service->name = $req->serviceName;
                $saving_status = $service->save();
                if ($saving_status) {
                    Session::flash('success', 'Service add successfully...');
                    return redirect()->route('office-services');
                    exit();
                } else {
                    Session::flash('failed', 'Service adding failed...');
                    return redirect()->route('office-services');
                    exit();
                }
            } else {
                Session::flash('warning', 'This service already exist...');
                return redirect()->route('office-services');
                exit();
            }
        } else {
            return view('office_admin.services.services-add');
        }
    }
    // edit
    function edit(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Service::where('name', trim($req->serviceName))->get();
            if (count($check) <= 0) {
                $service = Service::findOrFail($req->id);
                $service->name = $req->serviceName;
                $saving_status = $service->save();
                if ($saving_status) {
                    Session::flash('success', 'Service updated successfully...');
                    return redirect()->route('office-services');
                    exit();
                } else {
                    Session::flash('failed', 'Service updation failed...');
                    return redirect()->route('office-services');
                    exit();
                }
            } else {
                Session::flash('warning', 'This service already exist...');
                return redirect()->route('office-services');
                exit();
            }
        } else {
            
            $service = Service::findOrFail($req->id);
            return view('office_admin.services.services-edit', compact('service'));
        }
    }

    // delete services
    function delete(Request $req)
    {
        $service = Service::findOrFail($req->id)->delete();
        if ($service) {
            Session::flash('success', 'Service delete successfully...');
            return redirect()->route('office-services');
            exit();
        } else {
            Session::flash('failed', 'Service deletion failed...');
            return redirect()->route('office-services');
            exit();
        }
    }

    // change status
    function changeStatus(Request $req) {

        if($req->isMethod('POST')) {
            $result = Service::where('id', $req->id)->update(['status' => $req->status]);
         if($result) {
            return redirect()->route('office-services')->with('success', 'Service status updated successfully...!');
            exit();
         } else {
            return redirect()->route('office-services')->with('failed', 'Service status updation failed, try again...!');
            exit();
         }
        }
    }
}

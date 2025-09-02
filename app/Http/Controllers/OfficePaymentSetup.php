<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Paymentsetup;

class OfficePaymentSetup extends Controller
{
    function index(Request $req) {
        $payment = Paymentsetup::all()->sortByDesc("created_at");
        return view('office_admin.payment_setup.payment', compact('payment'));
    }

     // add payment
     function add(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Paymentsetup::where('name', trim($req->name))->get();
            if (count($check) <= 0) {
                $payment = new Paymentsetup();
                $payment->name = $req->name;
                $payment->price = $req->price;
                $payment->normal_discount = $req->discount;
                $saving_status = $payment->save();
                if ($saving_status) {
                    Session::flash('success', 'Payment add successfully...');
                    return redirect()->route('office-payment');
                    exit();
                } else {
                    Session::flash('failed', 'Payment adding failed...');
                    return redirect()->route('office-payment');
                    exit();
                }
            } else {
                Session::flash('warning', 'This payment already exist...');
                return redirect()->route('office-payment');
                exit();
            }
        } else {
            return view('office_admin.payment_setup.payment_add');
        }
    }

       // edit
       function edit(Request $req)
    {
        if ($req->isMethod('post')) {
            $check = Paymentsetup::where('name', trim($req->name))
            ->where('id', '!=', $req->id)
            ->get();
            if (count($check) <= 0) {
                $payment = Paymentsetup::findOrFail($req->id);
                $payment->name = $req->name;
                $payment->price = $req->price;
                $payment->normal_discount = $req->discount;
                $saving_status = $payment->save();
                if ($saving_status) {
                    Session::flash('success', 'Payment updated successfully...');
                    return redirect()->route('office-payment');
                    exit();
                } else {
                    Session::flash('failed', 'Payment updation failed...');
                    return redirect()->route('office-payment');
                    exit();
                }
            } else {
                Session::flash('warning', 'This Payment already exist...');
                return redirect()->route('office-payment');
                exit();
            }
        } else {
            $payment = Paymentsetup::findOrFail($req->id);
            return view('office_admin.payment_setup.payment_edit', compact('payment'));
        }
    }

      // delete payment
      function delete(Request $req)
    {
        $payment = Paymentsetup::findOrFail($req->id)->delete();
        if ($payment) {
            Session::flash('success', 'Payment delete successfully...');
            return redirect()->route('office-payment');
            exit();
        } else {
            Session::flash('failed', 'Payment deletion failed...');
            return redirect()->route('office-payment');
            exit();
        }
    }


    function coupon(Request $req) {
       
        if(isset($req->coupon)) {

            $coup = array();
            for($i = 0; $i < count($req->coupon); $i++) {
                $coup[$i][$req->coupon[$i]] = $req->discount[$i];
            }
            $payment = Paymentsetup::findOrFail($req->id)->update(['coupon' => json_encode($coup)]);
            if ($payment) {
                Session::flash('success', 'Payment coupon updated successfully...');
                return redirect()->route('office-payment');
                exit();
            } else {
                Session::flash('failed', 'Payment coupon updation failed...');
                return redirect()->route('office-payment');
                exit();
            }

        } else {
            $payment = Paymentsetup::findOrFail($req->id)->update(['coupon' => json_encode(null)]);
            if ($payment) {
                Session::flash('success', 'Payment coupon updated successfully...');
                return redirect()->route('office-payment');
                exit();
            } else {
                Session::flash('failed', 'Payment coupon updation failed...');
                return redirect()->route('office-payment');
                exit();
            }
        }

   }
}

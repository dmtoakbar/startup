<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admindetail;
use Mail;
use App\Mail\AdminEmailVerifyLink;
use App\Mail\AdminForgetPasswordLink;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class OfficeAdminController extends Controller
{
    // display dashboard of office admin panel
    function index() {
        return view('office_admin.index');
    }

    function adminUser() {
        $adminUser = User::all()->sortByDesc("created_at");
        $adminUserDetail = Admindetail::all();
        return view('office_admin.admin_user.admin-user', compact('adminUser', 'adminUserDetail'));
    }

    function adminUserAdd(Request $req) {

         // verify email exist or not
         if (isset($req->verify_condition)) {
            $email = $req->email;
            $checkemail = User::where('email', trim($email))->get();
            if (count($checkemail) > 0) {
                $msg = 'Email id already exists !';
                $color = 'red';
                return response()->json(['msg' => $msg, 'color' => $color], 200);
                exit();
            } else {
                $msg = "It's available !";
                $color = 'blue';
                return response()->json(['msg' => $msg, 'color' => $color], 200);
                exit();
            }
        }
        // end verify email exist or not
          //  register user
          if (isset($req->register_condition)) {
            $req->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'confirm_password' => 'required|same:password',
            ]);
            // admin primary data
            $su = new User();
            $su->name = trim($req->name);
            $su->email = trim($req->email);
            $su->password = Hash::make($req->password);
            $result = $su->save();
            // end admin primary data
            // admin secondary data
            $token_id = str::random(30);
            $token_key = str::random(60);
            $token_expiry_time = time() + 30 * 60;
            $sud = new Admindetail();
            $sud->email = trim($req->email);
            $sud->email_verify_token_id = $token_id;
            $sud->email_verify_token_key = $token_key;
            $sud->email_verify_expiry_time = $token_expiry_time;
            $sub_result = $sud->save();
            // end admin secondary data
            $link = "http://localhost:8000/admin/verify/email/$token_id/$token_key";
            Mail::to($req->email)->send(new AdminEmailVerifyLink($link));
            if($result && $sub_result) {
            Session::flash('success', 'Admin user added successfully...!');
            return redirect()->route('office-admin-user');
            exit();
            } else {
            Session::flash('failed', 'Something went wrong, Please try again...!');
            return redirect()->route('office-admin-user');
            exit();
            }
            
          }
        // end register user

        return view('office_admin.admin_user.admin-registration');
    }


    // verify email
    public function verifyEmail(Request $req) {

        $id = trim($req->id);
        $key = trim($req->key);

        $verify = Admindetail::where('email_verify_token_id', $id)->where('email_verify_token_key', $key)->get()->sortByDesc('id');
        if(count($verify) > 0) {
            $email = $verify[0]->email;

            // check already verified
             $check = User::where('email', $email)->get();
             if($check[0]->email_verified_at != null) {
                Session::flash('warning', '');
                return view('office_admin.admin_user.verify_email');
                exit();
                
             }
            // end check already verified

            $expiry_time = $verify[0]->email_verify_expiry_time;

            if($expiry_time >= time()) {
               $date_time = date('Y-m-d H:i:s');
               $user = User::where('email', $email)->update(['email_verified_at' => $date_time]);
                if($user) {
                    Session::flash('success', '');
                    return view('office_admin.admin_user.verify_email');
                    exit();
                } else {
                    Session::flash('wrong', '');
                    return view('office_admin.admin_user.verify_email');
                    exit();
                }
            } else {
                Session::flash('failed', '');
                return view('office_admin.admin_user.verify_email');
                exit();
            }
            
        } else {
            return abort(404);
            exit();
        }

    }
    // end verify email

    public function adminLogin(Request $req) {

        // relaod captcha
        if (isset($req->reload_captcha)) {
            Session::forget('admin-captcha');
            $captcha_raw = md5(random_bytes(64));
            Session::put('admin-captcha', substr($captcha_raw, 0, 6));
            return response()->json(['captcha' => Session::get('admin-captcha')], 200);
            exit();
        }
        // end reload captcha
       
        // login
        if(isset($req->admin_login)) {
            $req->validate([
                'email' => 'required|email',
                'password' => 'required',
                'captcha' => 'required',
            ]);
              
            //  match captcha
            if (trim($req->captcha) != Session::get('admin-captcha')) {
                Session::forget('admin-captcha');
                $captcha_raw = md5(random_bytes(64));
                Session::put('admin-captcha', substr($captcha_raw, 0, 6));
                return redirect()->back()->with('failed', 'Captcha not matched...')->withInput();
                exit();
            }
            // end match captcha

           $remember_me = $req->remember_me;
           $check = User::where(['email' => trim($req->email)])->first();
           if($check && Hash::check($req->password, $check->password)) {
               if($check->email_verified_at != null) {
                   
                // check user status
                 $check_detail = Admindetail::firstWhere('email', trim($req->email));
                 if($check_detail->user_status == null) {
                  return redirect()->route('admin-login')->with('warning', 'You are not approved still, Please wait for approval...!');
                  exit();
                 } else if($check_detail->user_status == "Restricted") {
                    return redirect()->route('admin-login')->with('warning', 'You are not restricted to login...!');
                    exit();
                 }
                // end check user status

               // login logic
                if($remember_me == 'on') {
                   Auth::attempt(['email' => trim($req->email), 'password' => trim($req->password)], true);
                } else {
                    Auth::attempt(['email' => trim($req->email), 'password' => trim($req->password)], false);
                }
                if (Auth::check()) {
                    Admindetail::where('email', Auth::user()->email)->update(['last_login_ip' => $req->ip(), 'last_login_time' => date("Y-m-d H:i:s")]);
                    Session::flash('success', 'Logged in successfully...!');
                    $req->session()->put('logged-password-input', trim($req->password));
                    return redirect()->route('office-admin');
                    exit();
                } else {
                    Session::flash('failed', 'Something went wrong, please try again...!');
                    return redirect()->route('admin-login');
                    exit();
                } 
                // end login logic
               } else {
                Session::flash('email-verify-link', trim($req->email));
                return redirect()->route('admin-resend-email-verify-link');
               exit();
               }
           } else {
            Session::flash('failed', 'Email or Password is not matched, try again...!');
            return redirect()->route('admin-login');
            exit();
           }
        }
        //end login
        $captcha_raw = md5(random_bytes(64));
        Session::put('admin-captcha', substr($captcha_raw, 0, 6));
        return view('office_admin.admin_user.admin_login');
        exit();
    }

    // resend email verify link
     public function resendEmailVerifyLink(Request $req) {

        if(Session::has('email-verify-link')) {
            return view('office_admin.admin_user.resend_email_verify_link');
            exit();

        } else if(isset($req->admin_verify_link)) {
        
            // admin secondary data update
            $token_id = str::random(30);
            $token_key = str::random(60);
            $token_expiry_time = time() + 30 * 60;
            $sud = Admindetail::where('email', trim($req->email))->first();
            $sud->email_verify_token_id = $token_id;
            $sud->email_verify_token_key = $token_key;
            $sud->email_verify_expiry_time = $token_expiry_time;
            $sub_result = $sud->save();
            // end admin secondary data update
            $link = "http://localhost:8000/admin/verify/email/$token_id/$token_key";
            Mail::to($req->email)->send(new AdminEmailVerifyLink($link));
            if($sub_result) {
            Session::flash('success', 'Email sent successfully, check email inbox and verify email...!');
            return redirect()->route('admin-login');
            exit();
            } else {
            Session::flash('failed', 'Something went wrong, Please try again...!');
            return redirect()->route('admin-login');
            exit();
            }
      
        } else {
            return redirect()->route('admin-login');
            exit();
        }

     }
    // end resend email verify link

    public function forgetPassword(Request $req) {

        if(isset($req->admin_forget_password)) {
            $sud = Admindetail::where('email', trim($req->email))->first();
            if($sud) {

                // admin secondary data update
                $token_id = str::random(30);
                $token_key = str::random(60);
                $token_expiry_time = time() + 10 * 60;
                $sud->password_forget_token_id = $token_id;
                $sud->password_forget_token_key = $token_key;
                $sud->password_forget_expiry_time = $token_expiry_time;
                $sub_result = $sud->save();
                // end admin secondary data update
                $link = "http://localhost:8000/admin/password/forget/link/$token_id/$token_key";
                Mail::to($req->email)->send(new AdminForgetPasswordLink($link));
                if($sub_result) {
                Session::flash('success', 'Forget password link successfully sent on email, check email inbox and reset password...!');
                return redirect()->route('admin-login');
                exit();
                } else {
                Session::flash('failed', 'Something went wrong, Please try again...!');
                return redirect()->route('admin-login');
                exit();
                }

            } else {
                Session::flash('failed', 'Opps, Email is not registered...!');
                return redirect()->route('admin-login');
                exit();
            }
          
        }

        return view('office_admin.admin_user.forget_password_email');
    }


    public function passwordForgetLinkVerify(Request $req) {

        if(isset($req->id) && isset($req->key)) {
            $verify = Admindetail::where('password_forget_token_id', $req->id)->where('password_forget_token_key', $req->key)->get()->sortByDesc('id');
            if(count($verify) > 0) {
                $email = $verify[0]->email;
                $expiry_time = $verify[0]->password_forget_expiry_time;

                if($expiry_time >= time()) {
                    Session::flash('reset-form', '');
                    return view('office_admin.admin_user.forget_password_form', compact('email'));
                    exit();
                } else {
                    Session::flash('expiry-time', '');
                    return view('office_admin.admin_user.forget_password_form');
                    exit();
                }
                
            } else {
                return abort(404);
                exit();
            }

        } else if($req->isMethod('post') && isset($req->reset_password)) {
            $req->validate([
                'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'confirm_password' => 'required|same:password',
            ]);
            $user = User::where('email', $req->email)->update(['password' => Hash::make($req->password)]);
                    if($user) {
                        Session::flash('success', 'Congrants!, you reset password successfully. Login now...!');
                        return redirect()->route('admin-login',);
                        exit();
                    } else {
                        Session::flash('wrong', '');
                        return redirect()->back();
                        exit();
                    }
        } else {
            return abort(404);
            exit();
        }

    }


    // admin logout
    function adminLogOut(Request $req) {
        if($req->session()->has('logged-password-input')){
            $id = Auth::user()->id;
            $email = Auth::user()->email;
            Auth::logout();
            User::where('id', $id)->update(['remember_token' => null]);
            Admindetail::where('email', $email)->update(['last_log_out_time' => date("Y-m-d H:i:s")]);
            $req->session()->invalidate();
            $req->session()->regenerateToken();
            Auth::logoutOtherDevices($req->session()->get('logged-password-input'));
            $req->session()->forget('logged-password-input');
            Session::flash('success', 'You logout successfully...!');
            return redirect()->route('admin-login',);
            exit();
        } else {
            Session::flash('failed', 'Something went wrong, please try again...!');
            return redirect()->back();
            exit();
        }
    }
    //end admin logout

   //change user status
    function changeAdminUserStatus(Request $req) {

        if($req->isMethod('POST')) {
            $email = Crypt::decrypt($req->email);
            $status = $req->status_change;
            $result = Admindetail::where('email', $email)->update(['user_status' => $status]);
            if($result) {
                return redirect()->route('office-admin-user')->with('success', 'Admin user status updated successfully..!');
                exit();
            } else {
                return redirect()->route('office-admin-user')->with('failed', 'Something went wrong, Please try again..!');
                exit();
            } 
        }

        $email = $req->email;
        return view('office_admin.admin_user.change_admin_user_status', compact('email'));
    }

    // end change user status

    // change admin user type
    function changeAdminUserType(Request $req) {

    if($req->isMethod('POST')) {
        $email = Crypt::decrypt($req->email);
        $type = $req->type_change;
        $result = Admindetail::where('email', $email)->update(['user_type' => $type]);
        if($result) {
            return redirect()->route('office-admin-user')->with('success', 'Admin user type updated successfully..!');
            exit();
        } else {
            return redirect()->route('office-admin-user')->with('failed', 'Something went wrong, Please try again..!');
            exit();
        } 
    }

    $email = $req->email;
    return view('office_admin.admin_user.change_admin_user_type', compact('email'));
    exit();
   }
  // end change admin user type
   // show admin detail
   function showAdminDetail(Request $req) {
        $detail = Crypt::decrypt($req->detail);
        $name = Crypt::decrypt($req->name);
        return view('office_admin.admin_user.show_admin_detail', compact('detail', 'name'));
        exit();
   }
   // end show admin detail
  
   // delete admin
   function deleteAdminUser(Request $req) {
    $email = Crypt::decrypt($req->email);
    $user = User::where('email', $email)->delete();
    $user_detail = Admindetail::firstWhere('email', $email);
    $destination = 'admin_profile_img/'.$user_detail->profile_img;
    if(File::exists($destination))
    {
        File::delete($destination);
    }
    $user_detail->delete();
    if($user && $user_detail) {
     return redirect()->route('office-admin-user')->with('success', 'User and his detail deleted successfully...!');
     exit();
    } else {
    return redirect()->route('office-admin-user')->with('failed', 'Something went wrong, Please try again...!');
    exit();
    }
   }
   // end delete admin

   // fill profile data
   function fillAdminProfileData(Request $req) {
          $admin_detail = Admindetail::firstWhere('email', Auth::user()->email);
          $admin_detail->mobile_number = trim($req->input('mobile_number'));
          $admin_detail->alternate_mobile_number = trim($req->input('alternate_mobile_number'));
          $admin_detail->address = trim($req->input('address'));
          if($req->hasfile('img'))
        {
            $destination = 'admin_profile_img/'.$admin_detail->profile_img;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $file = $req->file('img');
            $extention = $file->getClientOriginalExtension();
            $filename = 'admin_profile'.time().'.'.$extention;
            $file->move('admin_profile_img/', $filename);
            $admin_detail->profile_img = $filename;
        }
        $saving_status = $admin_detail->update();
        if ($saving_status) {
            Session::flash('success', 'Profile updated successfully...');
            return redirect()->back();
            exit();
        } else {
            Session::flash('failed', 'Profile updating failed...');
            return redirect()->back();
            exit();
        }
   }
   // end fill profile data
   

   // redirect without cache

   function applicationCacheClear(Request $req) {

    if($req->session()->has('key')) {
     $req->session()->flash($req->session()->get('key'), $req->session()->get('message'));
    }

    $route_name = $req->session()->get('route-to-ridirect');
    return redirect()->route($route_name);
    exit();
   }
   //  end redirect without cache

   // department update
   function adminUserDeparmentUpdate(Request $req) {

    if($req->isMethod('POST')) {
        $email = Crypt::decrypt($req->email);
        $department = $req->department;
        $result = Admindetail::where('email', $email)->update(['department' => $department]);
        if($result) {
            return redirect()->route('office-admin-user')->with('success', 'Admin user department updated successfully..!');
            exit();
        } else {
            return redirect()->route('office-admin-user')->with('failed', 'Something went wrong, Please try again..!');
            exit();
        } 
    }
    $email = $req->email;
    return view('office_admin.admin_user.admin_user_department_update', compact('email'));
   }
   // end deparment update

}

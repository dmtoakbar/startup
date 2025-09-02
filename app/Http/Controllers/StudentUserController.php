<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Studentuser;
use App\Models\Service;
use App\Models\Questionpaperfront;
use App\Models\Questionpaper;
use Mail;
use App\Mail\OtpEmail;

class StudentUserController extends Controller
{
    public function register(Request $req)
    {
        // verify email exist or not
        if (isset($req->verify_condition)) {
            $email = $req->email;
            $checkemail = Studentuser::where('email', trim($email))->get();
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
                'mobile' => 'required|numeric',
                'email' => 'required|email|unique:studentusers',
                'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'confirm_password' => 'required|same:password',
            ]);

            $su = new Studentuser();
            $su->name = trim($req->name);
            $su->mobile_number = trim($req->mobile);
            $su->email = trim($req->email);
            $su->password = Hash::make($req->password);
            //  create otp
            $otp = rand(100000, 999999);
            $otp_expiry = time() + 10 * 60;
            // end
            $su->otp = $otp;
            $su->otp_expiry = $otp_expiry;
            $su->save();
            Session::put('user_id', $su->id);
            Mail::to($req->email)->send(new OtpEmail($otp));

            Session::flash('success', 'OTP successfully sent on your Email, Please check and verify it...');
            return redirect('/user/register/otp-validate');
            exit();
        }
        // end register user
        return view('student_user.register');
    }

    // validate user otp
    public function validateUserOtp(Request $req)
    {
        if (!Session::has('user_id')) {
            return abort(404);
            exit();
        }

        // return otp expiry time
        if (isset($req->timer_condition)) {
            $su = Studentuser::find(Session::get('user_id'));
            $timer = $su->otp_expiry - time();
            if ($timer <= 0) {
                $timer = 0;
            }
            return response()->json(['timer' => $timer], 200);
            exit();
        }
        // end return otp expiry time

        //  resend otp
        if (isset($req->resend_otp)) {
            $su = Studentuser::find(Session::get('user_id'));
            //  create otp
            $otp = rand(100000, 999999);
            $otp_expiry = time() + 10 * 60;
            // end
            $su->otp = $otp;
            $su->otp_expiry = $otp_expiry;
            $su->update();
            Mail::to($su->email)->send(new OtpEmail($otp));
            // timer
            $timer = $su->otp_expiry - time();
            if ($timer <= 0) {
                $timer = 0;
            }
            // end timer
            $msg = 'OTP successfully resent..!';
            $color = 'blue';
            return response()->json(['timer' => $timer, 'msg' => $msg, 'color' => $color], 200);
            exit();
        }
        // end resend otp

        //  verify otp
        if ($req->isMethod('post')) {
            $otp = trim($req->otp);
            $su = Studentuser::find(Session::get('user_id'));
            if ($otp == $su->otp) {
                if ($su->otp_expiry >= time()) {
                    $su->is_otp_verified = '1';
                    $su->update();
                    Session::forget('user_id');
                    if (Session::has('password_create')) {
                        return redirect('/user/forget-password-form')->with('success', 'OTP successfully verified, Login now...');
                        exit();
                    }
                    return redirect('user/login')->with('success', 'OTP successfully verified, Login now...');
                    exit();
                } else {
                    return redirect()->back()->with('failed', 'Otp expired...');
                    exit();
                }
            } else {
                return redirect()->back()->with('failed', 'Invalid OTP, Kindly enter OTP sent on your Email...');
                exit();
            }
        }

        // end verify otp

        // show otp verify form
        return view('student_user.validate-otp');
        exit();
        // end otp verify form
    }
    // end validate user otp

    // student user login
    public function login(Request $req)
    {
        // relaod captcha
        if (isset($req->reload_captcha)) {
            Session::forget('captcha');
            $captcha_raw = md5(random_bytes(64));
            Session::put('captcha', substr($captcha_raw, 0, 6));
            return response()->json(['captcha' => Session::get('captcha')], 200);
            exit();
        }
        // end reload captcha

        if (isset($req->login_condition)) {
            // form validate
            $req->validate([
                'email' => 'required|email',
                'password' => 'required',
                'captcha' => 'required',
            ]);
            // end form validate

            //  match captcha
            if (trim($req->captcha) != Session::get('captcha')) {
                Session::forget('captcha');
                $captcha_raw = md5(random_bytes(64));
                Session::put('captcha', substr($captcha_raw, 0, 6));
                return redirect()->back()->with('failed', 'Captcha not matched...')->withInput();
                exit();
            }
            // end match captcha

            // login try
            $su = Studentuser::where(['email' => trim($req->email)])->first();
            if (!$su || !Hash::check($req->password, $su->password)) {
                Session::forget('captcha');
                $captcha_raw = md5(random_bytes(64));
                Session::put('captcha', substr($captcha_raw, 0, 6));
                return redirect()->back()->with('failed', 'email or password not matched...')->withInput();
                exit();
            } else {
                // check email verify or not
                if ($su->is_otp_verified == 0) {
                    // generate otp
                    $otp = rand(100000, 999999);
                    $otp_expiry = time() + 10 * 60;
                    // end
                    $su->otp = $otp;
                    $su->otp_expiry = $otp_expiry;
                    $su->update();
                    Session::put('user_id', $su->id);
                    Mail::to($su->email)->send(new OtpEmail($otp));

                    Session::flash('failed', 'Email is not verified, Please verify your email..');
                    Session::flash('success', 'OTP successfully sent on your Email...');
                    return redirect('/user/register/otp-validate');
                    exit();
                }
                // end check email verify or not
                Session::forget('captcha');
                $req->session()->put('user_authenticate', $su);
                return redirect('/');
                exit();
            }
            // end login try
        }

        // show login form
        $captcha_raw = md5(random_bytes(64));
        Session::put('captcha', substr($captcha_raw, 0, 6));
        return view('student_user.login');
        exit();
        // end show login form
    }
    // end student user login

    // forget password
    public function forgetPassword(Request $req)
    {
        if (isset($req->forget_password_condition)) {
            // validate email
            $req->validate([
                'email' => 'required|email',
            ]);
            // end validate email

            // check email existance
            $email = trim($req->email);
            $su_check = Studentuser::where('email', $email)->get();
            if (count($su_check) <= 0) {
                // if user does not exist
                return redirect()->back()->with('failed', 'This email is not registered...')->withInput();
                exit();
            } else {
                // if user exist
                $id = $su_check->first()->id;
                $su = Studentuser::find($id);
                $otp = rand(100000, 999999);
                $otp_expiry = time() + 10 * 60;
                // end
                $su->otp = $otp;
                $su->otp_expiry = $otp_expiry;
                $su->update();
                Session::put('user_id', $su->id);
                Session::put('password_create', $su->id);
                Mail::to($su->email)->send(new OtpEmail($otp));

                Session::flash('success', 'OTP successfully sent on your Email...');
                return redirect('/user/register/otp-validate');
                exit();
            }
            // end check email existance
        }

        return view('student_user.forget-password');
    }
    // end forget password

    // forget password form
    public function forgetPasswordForm(Request $req)
    {
        if (!Session::has('password_create')) {
            return abort(404);
            exit();
        }

        // create password
        if (isset($req->create_password_condition)) {
            $req->validate([
                'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'confirm_password' => 'required|same:password',
            ]);

            $id = Session::get('password_create');
            $su = Studentuser::find($id);
            $su->password = Hash::make($req->password);
            $su->save();
            if ($su) {
                Session::forget('password_create');
                return redirect('/user/login')->with('success', 'Password successfully changed, Login now..');
                exit();
            } else {
                return redirect()->back()->with('failed', 'Something went wrong, try again..');
                exit();
            }
        }
        // end create password

        return view('student_user.reset-password-form');
    }
    // end forget password form

    // exam intro
    public function examIntroFirst(Request $req)
    {
        $examIntro = Questionpaperfront::findOrFail(trim($req->id));

        return view('student_user.exam.exam-intro-first', compact('examIntro'));
    }

    public function examIntroSecond(Request $req)
    {
        $examIntro = Questionpaperfront::findOrFail(trim($req->id));

        return view('student_user.exam.exam-intro-second', compact('examIntro'));
    }
    // end exam intro

    // exam
    public function examAttempt(Request $req)
    {
        $examIntro = Questionpaperfront::findOrFail(trim($req->id));
        $subject = Questionpaper::where('questionpaperfronts_id', trim($req->id))
            ->select()
            ->get()
            ->unique('subject')
            ->sortByDesc('id');
        $questions = Questionpaper::where('questionpaperfronts_id', trim($req->id))
            ->get()
            ->sortByDesc('id');
        return view('student_user.exam.exam-attempt', compact('examIntro', 'questions', 'subject'));
    }
    // end

    // exam submit
    function examSubmit(Request $req)
    {
        if (isset($req->submit_test_condition)) {
            $questionArray = $req->question_array;
            $userResponse = $req->user_response;
            $totalQuestion = $req->question_no;

            $givenanswer = 0;

            for ($i = 1; $i <= $totalQuestion; $i++) {
                if ($userResponse[$i]['answer'] == 'yes' && $userResponse[$i]['markForReview'] == 'no') {
                    $givenanswer++;
                }
            }

            return response()->json(['givenanswer' => $givenanswer], 200);
            exit();
        } else {
            return abort(404);
            exit();
        }
    }
    // end exam submit
}

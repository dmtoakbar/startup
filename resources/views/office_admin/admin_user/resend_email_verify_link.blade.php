@extends('../../master')
@section('body')
    <div class="container" style="margin-top: 50px; margin-bottom: 60px;">
        <div class="row my-4">
            <div class="col-md-6 offset-md-3">
                 <h4 style="text-align: center">StudyLearn Admin Email Verify</h4>
                 <br>
                 <div style="text-align: center;">
                    <div class="alert alert-danger">Opps, Email is not verified, check your email box and verify email.
                         <br><strong>OR</strong><br>
                        Click bellow button to resend email verification link again.
                    </div>
                    <form action="{{route('admin-resend-email-verify-link')}}">
                        @csrf
                        <input type="hidden" name="admin_verify_link" value="admin_verify_link">
                        <input type="hidden" name='email' value="{{Session::get('email-verify-link')}}">
                        <button type="submit" class="btn btn-primary">Resend Email</button>
                    </form>
                 </div>
                <br>
            </div>
        </div>
    </div>
@endsection
@section('script-and-files')

@endsection
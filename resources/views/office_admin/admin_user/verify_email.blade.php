@extends('../../master')
@section('body')
    <div class="container" style="margin-top: 50px; margin-bottom: 60px;">
        <div class="row my-4">

            @if (Session::has('success'))
            <div class="col-10 offset-1" style="height: 300px; border-radius: 20px; text-align: center;">
                <div style="margin-top: 120px;">
                    <p class="btn btn-primary" style="color: white;">Hello sir, Your email is verified. Now, you can start your work..!</p>
                     <br>
                    <a href="{{route('admin-login')}}" class="btn btn-success">Login Now</a>
                </div>
              </div>
            @elseif(Session::has('failed'))
            <div class="col-10 offset-1" style="height: 300px; border-radius: 20px; text-align: center;">
            <div style="margin-top: 105px;">
                <p class="btn btn-danger" style="color: white;">Opps, Link is expired. Resend link and verify your email to start work...!</p>
                <br>
                <a href="#" class="btn btn-warning"><strong>Link is valid for 30 minutes only...</strong></a>
            </div>
            </div>
            @elseif(Session::has('wrong'))
            <div class="col-10 offset-1" style="height: 300px; border-radius: 20px; text-align: center;">
            <div style="margin-top: 105px;">
                <p class="btn btn-danger" style="color: white;">Opps, Something went wrong. Please try again...!</p>
                <br>
                <a href="#" class="btn btn-warning"><strong>Link is valid for 30 minutes only...</strong></a>
            </div>
            </div>
            @elseif(Session::has('warning'))
            <div class="col-10 offset-1" style="height: 300px; border-radius: 20px; text-align: center;">
                <div style="margin-top: 120px;">
                    <p class="btn btn-warning">Hello sir, Your email is already verified. Now, you can start your work..!</p>
                     <br>
                    <a href="{{route('admin-login')}}" class="btn btn-success">Login Now</a>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection
@section('script-and-files')
@endsection
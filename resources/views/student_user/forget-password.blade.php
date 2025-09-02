@extends('master')
@section('body')
    <div class="container" style="padding-top: 50px !important; padding-bottom: 50px !important;">
        <style>
            input {
                border: 1px solid rgb(34, 32, 32) !important;
            }
        </style>
        <div class="row  align-item-center">
            <div class="col-md-6 offset-md-3">
                <h3 class="text-center">Reset Password</h3>
                <p class="text-center text-primary">Please, fill each and every detail carefully..</p>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @elseif(Session::has('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @elseif(Session::has('warning'))
                    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                @endif
                <form action="{{ route('user-forget-password') }}" method="POST">
                    @csrf
                    <input type="hidden" name='forget_password_condition' value="forget_password_condition">
                    <div class="form-group" style="padding-bottom: 10px !important;">
                        <label for="">Email address:</label><br>
                        <small class="email_error"></small>
                        <input type="email" class="form-control email_id" name="email" value="{{ old('email') }}"
                            placeholder="Enter email" required>
                        <small class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <a href="{{route('user-login')}}" class="btn btn-danger float-start">Login</a>
                    <a href="{{ route('user-register') }}" class="btn btn-success float-start" style="margin-left: 10px">Sign Up</a>
                    <button type="submit" class="btn btn-primary float-end">Verify Email</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-and-files')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $('.reload-captcha').click(function(e) {
                $.ajax({
                    url: '/user/login',
                    type: 'POST',
                    data: {
                        'reload_captcha': 'reload_captcha',
                    },
                    success: function(response) {
                        $('.pxdoubt').prop('value', response.captcha);
                    }
                });
            });

        });
    </script>
@endsection

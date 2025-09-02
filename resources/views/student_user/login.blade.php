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
                <h3 class="text-center">Login Now</h3>
                <p class="text-center text-primary">Please, fill each and every detail carefully..</p>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @elseif(Session::has('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @elseif(Session::has('warning'))
                    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                @endif
                <form action="{{ route('user-login') }}" method="POST">
                    @csrf
                    <input type="hidden" name='login_condition' value="login_condition">
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
                    <div class="form-group" style="padding-bottom: 10px !important;">
                        <label for="">Password:</label>
                        <input type="password" name="password" class="form-control p-first" placeholder="Password" required>
                        <small class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col" style="margin-top: 8px; ">
                            <input type="text" class="form-control text-center" name="captcha"
                                placeholder="Enter captcha..." required>
                            <small class="text-danger">
                                @error('captcha')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="col d-flex">
                            <style>
                                .pxdoubt {
                                    background-color: transparent;
                                    background-image: url('/image/captcha/bg6.png');
                                    letter-spacing: 2px;
                                    color: black;
                                    font-size: 26px;
                                    font-weight: bold;
                                    text-align: center;
                                }

                                @media (max-width: 400px) {
                                    .pxdoubt {
                                        letter-spacing: 0;
                                        text-align: left;
                                    }
                                }

                            </style>
                            <input onCopy="return false" onCut="return false" onDrag="return false" type="text"
                                class="form-control pxdoubt" value="{{ Session::get('captcha') }}" readonly />
                            <span class="reload-captcha" style="margin-left: 3px; margin-top: 14px;"><i
                                    class="fa fa-refresh" aria-hidden="true" style="color: blue;"></i></span>
                        </div>
                    </div>
                    <a href="{{route('user-forget-password')}}" class="btn btn-danger">Forget Password</a><br>
                    <br>
                    <a href="{{ route('user-register') }}" class="btn btn-success float-start">Sign Up</a>
                    <button type="submit" class="btn btn-primary float-end">Login Now</button>
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

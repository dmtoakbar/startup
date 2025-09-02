@extends('../../master')
@section('body')
    <div class="container" style="margin-top: 50px; margin-bottom: 60px;">
        <div class="row my-4">

            @if (Session::has('wrong'))
            <div class="col-10 offset-1" style="height: 300px; border-radius: 20px; text-align: center;">
                <div style="margin-top: 105px;">
                    <p class="btn btn-danger" style="color: white;">Opps, Something went wrong. Please try again...!</p>
                    <br>
                    <a href="#" class="btn btn-warning"><strong>Link is valid for 10 minutes only...</strong></a>
                </div>
                </div>
              @elseif(Session::has('reset-form'))
                <div class="col-md-6 offset-md-3">
                     <h4 style="text-align: center">StudyLearn Admin Reset Password</h4>
                     <div style="text-align: center"><p>Create New Password</p></div>
                    <form action="{{ route('admin-forget-password-link-verify') }}" role="form" method="POST">
                        @csrf
                        <input type="hidden" name='reset_password' value="reset_password">
                        <input type="hidden" name="email" value="{{$email}}">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control p-first-password" id="passwordInput" name="password"
                                    placeholder="Enter password" required 
                                    style="border: 1px solid grey;"
                                    >
                                  <span class="bg-white input-group-text" style="border: 1px solid grey;">
                                          <i class="fa fa-eye-slash" style="cursor: pointer" id="passwordIcon"></i>
                                      </span>
                                </div>
                              </div>
                              <div class="password-character" style="display: none; margin-top: -8px; margin-bottom: 5px; font-size: 18px;">
                                <small>Password must meeet the following conditions:</small><br>
                                <small class="p-s-letter">At least one small letter</small><br>
                                <small class="p-c-letter">At least one capital letter</small><br>
                                <small class="p-number">At least one number</small><br>
                                <small class="p-character">At least one special charater[# ? ! @ $ % ^ & * -]</small><br>
                                <small class="p-length">Be at least 8 characters</small><br>
                            </div>
                            <small class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </small>
                              <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <small class="password-match"></small>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control p-second" id="passwordInputC" name="confirm_password"
                                    placeholder="Confirm password" required 
                                    style="border: 1px solid grey;"
                                    >
                                  <span class="bg-white input-group-text" style="border: 1px solid grey;">
                                          <i class="fa fa-eye-slash" style="cursor: pointer" id="passwordIconC"></i>
                                      </span>
                                </div>
                              </div>
                              <small class="text-danger">
                                @error('confirm_password')
                                    {{ $message }}
                                @enderror
                            </small>
                            <br>
                            <button type="submit" class="btn btn-primary disabled float-end sign-email-status">Submit</button>
                    </form>
                    <br>
                </div>
            @elseif(Session::has('expiry-time'))
            <div class="col-10 offset-1" style="height: 300px; border-radius: 20px; text-align: center;">
            <div style="margin-top: 105px;">
                <p class="btn btn-danger" style="color: white;">Opps, Link is expired. You can resend link to reset password...!</p>
                <br>
                <a href="#" class="btn btn-warning"><strong>Link is valid for 10 minutes only...</strong></a>
            </div>
            </div>
            @endif

        </div>
    </div>
@endsection
@section('script-and-files')
<script>
    $(document).ready(function(){
    $('#passwordIcon').click(function(e) {
        if($('#passwordIcon').hasClass('fa-eye-slash')) {
            $('#passwordIcon').removeClass('fa-eye-slash').addClass('fa-eye');
            $("#passwordInput").prop("type", "text");
        } else {
            $('#passwordIcon').removeClass('fa-eye').addClass('fa-eye-slash');
            $("#passwordInput").prop("type", "password");
        }
    });
    $('#passwordIconC').click(function(e) {
        if($('#passwordIconC').hasClass('fa-eye-slash')) {
            $('#passwordIconC').removeClass('fa-eye-slash').addClass('fa-eye');
            $("#passwordInputC").prop("type", "text");
        } else {
            $('#passwordIconC').removeClass('fa-eye').addClass('fa-eye-slash');
            $("#passwordInputC").prop("type", "password");
        }
    });
  });
</script>
<script>
    $(document).ready(function() {
        $('.p-first-password').keyup(function(e) {

            var password = $('.p-first-password').val();
            if (password.length >= 8) {
                $('.p-length').removeClass('text-danger').addClass('text-primary');
            } else {
                $('.p-length').addClass('text-danger')
            }
            if (password.match(/\d/)) {
                $('.p-number').removeClass('text-danger').addClass('text-primary');
            } else {
                $('.p-number').addClass('text-danger')
            }
            if (password.match(/[A-Z]/)) {
                $('.p-c-letter').removeClass('text-danger').addClass('text-primary');
            } else {
                $('.p-c-letter').addClass('text-danger')
            }
            if (password.match(/[a-z]/)) {
                $('.p-s-letter').removeClass('text-danger').addClass('text-primary');
            } else {
                $('.p-s-letter').addClass('text-danger')
            }
            if (password.match(/[#?!@$%^&*-]/)) {
                $('.p-character').removeClass('text-danger').addClass('text-primary');
            } else {
                $('.p-character').addClass('text-danger')
            }

        }).focus(function() {
            $('.password-character').css('display', 'visible');
        }).blur(function() {
            $('.password-character').css('display', 'none');
        });


        $('.p-second').keyup(function(e) {
            var first = $('.p-first-password').val();
            var second = $('.p-second').val();
            if (second == first) {
                $('.password-match').css('color', 'blue');
                $('.password-match').text('Password match...');
                $('.sign-email-status').removeClass('disabled');
            } else {
                $('.password-match').css('color', 'red');
                $('.password-match').text('Password does not match..');
                $('.sign-email-status').addClass('disabled');
            }
        });

    });
</script>
@endsection
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
                <h3 class="text-center">Create Password</h3>
                <p class="text-center text-primary">Please, fill each and every detail carefully..</p>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @elseif(Session::has('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @elseif(Session::has('warning'))
                    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                @endif
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name='create_password_condition' value="create_password_condition">

                    <div class="form-group" style="padding-bottom: 10px !important;">
                        <label for="">Password:</label>
                        <div class="password-character" style="display: none;">
                            <small>Password must meeet the following conditions:</small><br>
                            <small class="p-s-letter">At least one small letter</small><br>
                            <small class="p-c-letter">At least one capital letter</small><br>
                            <small class="p-number">At least one number</small><br>
                            <small class="p-character">At least one special charater[# ? ! @ $ % ^ & * -]</small><br>
                            <small class="p-length">Be at least 8 characters</small><br>
                        </div>
                        <input type="password" name="password" class="form-control p-first" placeholder="Password" required>
                        <small class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <div class="form-group" style="padding-bottom: 10px !important;">
                        <label for="">Confirm password:</label><br>
                        <small class="password-match"></small>
                        <input type="password" name="confirm_password" class="form-control p-second"
                            placeholder="Confirm password" required>
                        <small class="text-danger">
                            @error('confirm_password')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>
                    <br>
                    <button type="submit"
                        class="btn btn-primary disabled float-end sign-email-status">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-and-files')
    <script>
        $(document).ready(function() {

            $('.p-first').keyup(function(e) {

                var password = $('.p-first').val();
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $('.p-second').keyup(function(e) {
                var first = $('.p-first').val();
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

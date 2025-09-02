@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Admin Users
                <small>Add Admin User</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Admin Users</a></li>
                <li class="active">Add Admin User</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header text-center">
                            <h3 class="box-title">Fill Details Carefully</h3>
                        </div><!-- /.box-header -->
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">

                                <form action="{{ route('office-admin-user-add') }}" role="form" method="POST">
                                    @csrf
                                    <input type="hidden" name='register_condition' value="register_condition">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                                placeholder="Enter name" required 
                                                style="border: 1px solid grey;"
                                                >
                                                <small class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email:</label>
                                            <small class="email_error"></small>
                                            <input type="email" class="form-control email_id" name="email" value="{{ old('email') }}"
                                                placeholder="Enter email" required 
                                                style="border: 1px solid grey;"
                                                >
                                                <small class="text-danger">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                        </div>
                                        <div class="form-group has-feedback has-feedback-right">
                                            <label for="">Password:</label>
                                            <input type="password" class="form-control p-first-password" id="passwordInput" name="password"
                                                placeholder="Enter password" required 
                                                style="border: 1px solid grey;"
                                                ><i class="glyphicon glyphicon-eye-close form-control-feedback" id="passwordIcon" style="pointer-events: auto;"></i>
                                        </div>
                                        <div class="password-character hidden" style="margin-top: -8px; margin-bottom: 5px; font-size: 18px;">
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
                                        <div class="form-group has-feedback has-feedback-right">
                                            <label for="">Confirm Password:</label>
                                            <small class="password-match"></small>
                                            <input type="password" class="form-control p-second" id="cPasswordInput" name="confirm_password"
                                                placeholder="Confirm password" required 
                                                style="border: 1px solid grey;"
                                                ><i class="glyphicon glyphicon-eye-close form-control-feedback" id="cPasswordIcon" style="pointer-events: auto;"></i>
                                        </div>
                                        <small class="text-danger">
                                            @error('confirm_password')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div><!-- /.box-body -->
                                    
                                

                                    <div class="box-footer text-right">
                                        <button type="submit" class="btn btn-primary disabled float-end sign-email-status">Sign up</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

@section('footer-scripts')
    <script>
        $(document).ready(function(){
        $('#passwordIcon').click(function(e) {
            if($('#passwordIcon').hasClass('glyphicon-eye-close')) {
                $('#passwordIcon').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
                $("#passwordInput").prop("type", "text");
            } else {
                $('#passwordIcon').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
                $("#passwordInput").prop("type", "password");
            }
        });

        $('#cPasswordIcon').click(function(e) {
            if($('#cPasswordIcon').hasClass('glyphicon-eye-close')) {
                $('#cPasswordIcon').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
                $("#cPasswordInput").prop("type", "text");
            } else {
                $('#cPasswordIcon').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
                $("#cPasswordInput").prop("type", "password");
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
            $('.password-character').removeClass('hidden');
        }).blur(function() {
            $('.password-character').addClass('hidden');
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
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

        $('.email_id').keyup(function(e) {
            var email = $('.email_id').val();
            $.ajax({
                url: '/office/admin/admin-user/add',
                type: 'POST',
                data: {
                    'verify_condition': 'verify-condition',
                    'email': email,
                },
                success: function(response) {

                    if (response.color == 'red') {
                        $('.email_error').css("color", "red");
                        $('.sign-email-status').addClass('disabled');
                    } else {
                        $('.email_error').css("color", "blue");
                        $('.sign-email-status').removeClass('disabled');
                    }
                    $('.email_error').text(response.msg);
                }
            });
        });
    });
</script>
@endsection

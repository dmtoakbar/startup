@extends('../../master')
@section('body')
    <div class="container" style="margin-top: 50px; margin-bottom: 60px;">
        <div class="row my-4">
            <div class="col-md-6 offset-md-3">
                 <h4 style="text-align: center">StudyLearn Admin Login</h4>
                 <br>
                 <div style="text-align: center;">
                    @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @elseif(Session::has('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                    @elseif(Session::has('warning'))
                    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                    @endif
                 </div>
                <form action="{{ route('admin-login') }}" role="form" method="POST">
                    @csrf
                    <input type="hidden" name='admin_login' value="admin_login">
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

                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="passwordInput" name="password"
                                placeholder="Enter password" required 
                                style="border: 1px solid grey;"
                                >
                              <span class="bg-white input-group-text" style="border: 1px solid grey;">
                                      <i class="fa fa-eye-slash" style="cursor: pointer" id="passwordIcon"></i>
                                  </span>
                            </div>
                          </div>
                          <small class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </small>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col" style="margin-top: 8px; ">
                                <input type="text" class="form-control text-center" name="captcha"
                                    placeholder="Enter captcha..." required style="border: 1px solid grey;">
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
                                    class="form-control pxdoubt" value="{{ Session::get('admin-captcha') }}" readonly />
                                <span class="reload-captcha" style="margin-left: 3px; margin-top: 14px;"><i
                                        class="fa fa-refresh" aria-hidden="true" style="color: blue;"></i></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-space-between">
                            <div class="input-group">
                                <input type="checkbox" name="remember_me">
                                <small class="input-group-text" style="border: none; background-color: transparent;">Remember me</small>
                            </div>
                            <a href="{{route('admin-forget-password')}}" class="btn btn-warning" style="width: 200px; padding: 5px; font-size: 14px;">Forget Password</a>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary float-end">Login</button>
                </form>
                <br>
            </div>
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
  });
</script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $('.reload-captcha').click(function(e) {
            $.ajax({
                url: '/admin/login',
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
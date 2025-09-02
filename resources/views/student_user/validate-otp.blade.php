@extends('master')
@section('body')
    <div class="container" style="padding-top: 50px !important; padding-bottom: 50px !important;">
        <div class="row  align-item-center">
            <div class="col-md-6 offset-md-3">
                <h3 class="text-center">Verify your Email</h3>
                <p class="text-center text-primary">To verify Email, check your email and enter OTP sent..</p>
                @if (Session::has('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('warning'))
                    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                @endif
                <form action="{{ route('validate-user-otp') }}" method="POST">
                    @csrf
                    <div class="form-group" style="padding-bottom: 10px !important;">
                        <label for="">OTP:</label>
                        <input type="number" class="form-control" name="otp" maxlength="6" placeholder="Enter OTP..."
                            required
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <div>Time left : <span id="timer"> <span id="minute"></span>m : <span
                                id="second"></span>s</span></div>
                    <br>
                    <p class="opt-resend"></p>
                    <div class="text-center resend-processing-ring" style="display: none;">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <p class="btn btn-success float-middle disabled resend-otp">Re-send OTP</p>
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
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

            $('.resend-otp').click(function(e) {
                $.ajax({
                    url: '/user/register/otp-validate',
                    type: 'POST',
                    data: {
                        'resend_otp': 'resend-otp',
                    },
                    success: function(response) {
                        // timer
                        $('.resend-otp').addClass('disabled');
                        var counter = response.timer;
                        var interval = setInterval(function() {
                            counter--;
                            var m = Math.floor(counter / 60);
                            var s = counter % 60;
                            if (counter <= 0) {
                                clearInterval(interval);
                                $('#minute').text(0);
                                $('#second').text(0);
                                $('.resend-otp').removeClass('disabled');
                                return;
                            } else {
                                $('#minute').text(m);
                                $('#second').text(s);
                            }
                        }, 1000);
                        // end timer
                        $('.opt-resend').css("color", "blue");
                        $('.opt-resend').text(response.msg);
                    }
                });
            });

            $(document).ajaxStart(function() {
                $('.resend-processing-ring').css('display', 'visible');
            });
            $(document).ajaxStop(function() {
                $('.resend-processing-ring').css('display', 'none');
            });
            $(document).ajaxError(function() {
                $('.resend-processing-ring').css('display', 'none');
            });
        });


        $(document).ready(function() {
            $.ajax({
                url: '/user/register/otp-validate',
                type: 'POST',
                data: {
                    'timer_condition': 'timer_condition',
                },
                success: function(response) {
                    // timer
                    var counter = response.timer;
                    var interval = setInterval(function() {
                        counter--;
                        var m = Math.floor(counter / 60);
                        var s = counter % 60;
                        if (counter <= 0) {
                            clearInterval(interval);
                            $('#minute').text(0);
                            $('#second').text(0);
                            $('.resend-otp').removeClass('disabled');
                            return;
                        } else {
                            $('#minute').text(m);
                            $('#second').text(s);
                        }
                    }, 1000);
                    // end timer
                }
            });
        });
    </script>
@endsection

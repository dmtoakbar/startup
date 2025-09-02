@extends('student_user/exam/master')
@section('body')
    <br><br>
    <div class="container" style="padding-bottom: 100px;">
        <div class="d-flex justify-content-center" style="margin-top: -40px; margin-bottom: 5px;">
            <span style="border: 2px solid black; padding: 5px; border-radius: 10px;"><a href="#"
                    class="main-logo-text">Equa <i class="fa fa-pencil"></i> Study</a></span>
        </div>
        <h3 style="border-bottom: 3px solid blue; padding-bottom: 5px; text-transform: capitalize;">
            {{ $examIntro->sub_title }}
        </h3>
        <div class="d-flex justify-content-center">
            <span class="btn btn-primary" style="font-size: 18px; font-weight: bold;">{{ $examIntro->test_name }}</span>
        </div>
        <br>
        <div class="decription" style="border: 1px solid grey; padding: 15px 10px;">
            <h5 style="color: blue; font-weight: bold;">Read the following Instruction carefully:</h5>
            <ul>
                <li>
                    This test comprises of multiple-choice questions
                </li>
                <li>
                    Each question will have only one of the available options as the correct answer.
                </li>
                <li>
                    You are advised not to close the browser window before submitting the test.
                </li>
                <li>
                    In case, if the test does not load completely or becomes unresponive, click on browser's refresh button
                    to relaod.
                </li>
            </ul>
        </div>
        <br>
        <div class="decription" style="border: 1px solid grey; padding: 15px 10px;">
            <h5 style="color: blue; font-weight: bold;">Marking Scheme:</h5>
            <ul>
                <li>
                    2 marks will be awarded for each correct answer.
                </li>
                <li>
                    There will be 1/4th negative marking for each wrong answer.
                </li>
                <li>
                    No marks will be deducted for un-attempted questions.
                </li>
            </ul>

        </div>
        <br>
        <div class="condition">
            <input class="check-box-status" type="checkbox">&nbsp;&nbsp;<span>I have read and understood all the
                instrunctions. I understand that using unfair means of any sort for any advantage will lead to immediate
                disqualification.</span>
        </div>
    </div>
    <div class="fixed-bottom" style="height: 60px; background-color: rgb(202, 200, 200);">
        <div style="margin-top: 13px;" class="container d-flex justify-content-between">
            <a href="{{ route('user-exam-intro-first', $examIntro->id) }}" class="btn text-white"
                style="background-color: red;"><i class="fa-solid fa-arrow-left text-white"></i> Previous</a>
            <a href="{{ route('user-exam-attempt', $examIntro->id) }}"
                class="btn text-white disabled check-box-action-effect" style="background-color: blue;">I am ready to begin
                <i class="fa-solid fa-arrow-right text-white"></i></a>
        </div>
    </div>
@endsection

@section('script-and-files')
    <script>
        // $(window).on("beforeunload", function(e) {
        //     return e.originalEvent.returnValue = "Changes will not be saved.";
        // });

        $('.check-box-status').on('click', function() {
            const status = $('.check-box-status').is(":checked");
            if (status) {
                $('.check-box-action-effect').removeClass('disabled');
            } else {
                $('.check-box-action-effect').addClass('disabled');
            }
        });
    </script>
@endsection

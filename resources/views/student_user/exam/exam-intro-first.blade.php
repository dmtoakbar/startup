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
            <h5 style="color: blue; font-weight: bold;">General Instructions:</h5>
            <ul>
                <li>The total duration of the examination is {{ $examIntro->duration }} minutes.</li>
                <li>The total questions of the examination are {{ $examIntro->total_question }} questions.</li>
                <li>The Clock will be set at the server. The countdown timer in the top right corner of screen will display
                    the remaining time available to you for completing the examination. When the timer reaches remaining 5
                    minutes, an alert screen will be displayed by itself. When timer reaches zero, the examination will end
                    by itself. You will not be required to end or submit your examination.</li>
                <li>The Question Pallete displayed on the right side just below of clock will show the status of each
                    question (subject wise) using one of the following symbols:
                    <ol>
                        <li>Answered question is in <span>blue color</span>.</li>
                        <li>Marked for review question is in <span>black color</span>.</li>
                        <li>Unanswered question is in <span>red color</span>.</li>
                        <li>Attempt question is in <span>green color</span>.</li>
                        <li>Unattempt question is in <span>black color</span>.</li>

                    </ol>
                </li>
                <li>Marked for review status for a question simply indicates that you would like to review the question
                    again.</li>
                <li>Please note that if a question is answered and 'marked for review', your answer for that question will
                    be considered in the evaluation.</li>
                <li>You can click on the question palette to navigate faster across questions.</li>
            </ul>
        </div>
        <br>
        <div class="decription" style="border: 1px solid grey; padding: 15px 10px;">
            <h5 style="color: blue; font-weight: bold;">Answering a question:</h5>
            <ul>
                <li>Procedure for the answering multiple-choice type questions:
                    <ol>
                        <li>To select you answer, click on the button of one of the options.</li>
                        <li>To deselect your chosen answer, click again on the button of the chosen option again or click on
                            the Clear Response button.</li>
                        <li>To change your chosen answer, click on the button of another option.</li>
                        <li>To save your answer, you must click on the Save & Next button.</li>
                    </ol>
                </li>
                <li>To mark a question for review, click on the mark for Review & Next button.</li>
                <li>To change answer to a question that has already been asnwered, select that question from the question
                    palette and the follow the procedure for answering that type of question.</li>
                <li>Note that ONLY Questions for which answers are save or marked for review after answering will be
                    considered for evaluation.</li>
            </ul>
        </div>
        <br>
        <div class="decription" style="border: 1px solid grey; padding: 15px 10px;">
            <h5 style="color: blue; font-weight: bold;">Navigation through sections:</h5>
            <ul>
                <li>
                    Click on the question number in Question Palette at the right of your screen to go to questions (subject
                    wise).
                </li>
                <li>
                    Note that using this option does not save your answer.
                </li>
                <li>
                    Click on Save & Next to save your answer for a question and then move to the next question.
                </li>
                <li>
                    If you want to keep a question marked for review, click on the button Mark for Review & Next to save
                    your answer for the current question and then proceed to the next question.
                </li>
            </ul>
        </div>
        <br>
    </div>
        <div class="fixed-bottom" style="height: 60px; background-color: rgb(202, 200, 200);">
            <div style="margin-top: 13px;" class="container d-flex justify-content-between">
            <a href="{{ route('site-test-collection-particular', $examIntro->id) }}" class="btn text-white" style="background-color: red;"><i class="fa-solid fa-arrow-left text-white"></i> Previous</a>
            <a href="{{route('user-exam-intro-second', $examIntro->id)}}" class="btn text-white" style="background-color: blue;">Next <i class="fa-solid fa-arrow-right text-white"></i></a>
            </div>
        </div>
@endsection

@section('script-and-files')
    <script>
        // $(window).on("beforeunload", function(e) {
        //     return e.originalEvent.returnValue = "Changes will not be saved.";
        // });
    </script>
@endsection

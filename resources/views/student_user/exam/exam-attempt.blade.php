@extends('student_user/exam/master')
@section('body')
    <style>
        .timer-block {
            height: 60px;
            border-radius: 5px;
            background-color: rgb(83, 83, 231);
        }

        .exam-timer {
            margin-top: 8px;
            font-size: 25px;
            font-weight: bold;
        }

        .question-sheet-subject {
            margin-top: 5px;
            font-weight: bold;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
        }

        .question-sheet-subject>span,
        span>i {
            color: wheat;
        }

        .question-sheet-number {
            padding-top: 10px;
            padding-bottom: 10px;
            display: grid;
            column-gap: 10px;
            row-gap: 10px;
            grid-template-columns: auto auto auto;
        }

        .question-sheet-number>.circle {
            min-width: 35px;
            min-height: 35px;
            background-color: black;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;


        }

        .unattempt {
            margin-bottom: 6px;
        }

        .attempt {
            margin-bottom: 6px;
        }

        .answered {
            margin-bottom: 6px;
        }

        @media only screen and (max-width: 768px) {
            .timer-block {
                height: 50px;
                width: 150px;
                border-radius: 5px;
            }

            .exam-timer {
                font-size: 20px;
            }

            .right-side-body {
                display: flex;
                justify-content: space-between;
            }

            .all-subjects-related {
                display: none;
            }

        }
    </style>
    <br><br>
    <div class="container">
        <div class="d-flex justify-content-center" style="margin-top: -40px; margin-bottom: 5px;">
            <span style="border: 2px solid black; padding: 5px; border-radius: 10px;"><a href="#"
                    class="main-logo-text">Equa <i class="fa fa-pencil"></i> Study</a></span>
        </div>
        <h3 style="border-bottom: 3px solid blue; padding-bottom: 5px; text-transform: capitalize;">css mts online test paper
        </h3>
        <div class="row">
            <div class="col-md-3">
                <div class="right-side-body">
                    <div class="right-side-body-first">
                        <div class="timer-block d-flex justify-content-center">
                            <p class="exam-timer"><span id="hour"></span>h&nbsp;:&nbsp;<span
                                    id="minute"></span>m&nbsp;:&nbsp;<span id="second"></span>s</p>
                        </div>

                    </div>
                    <div class="right-side-body-second">
                        <p style="display: flex; justify-content: center; align-items: center;  margin-top: 10px; font-size: 20px; font-weight: bold; color: white; background-color:rgb(211, 15, 15); border-radius: 5px; padding: 4px;"
                            class="d-md-flex d-none">Questions :</p>
                        <p style="height: 50px; width: 115px; display: flex; justify-content: center; align-items: center; font-size: 16px; font-weight: bold; color: white; background-color:rgb(211, 15, 15); border-radius: 5px; padding: 4px;"
                            class="d-md-none d-sm-flex question-small-screen">Questions&nbsp;<i
                                class="fa-solid fa-arrow-right text-white fa-icon-questions"></i></p>

                    </div>
                </div>
                <div class="all-subjects-related">
                    @php
                        $subjectFilter = [];
                        $sf = 0;
                        foreach ($subject as $item) {
                            $subjectFilter[$sf] = $item->subject;
                            $sf++;
                        }
                        $questionPart = [];
                        $questionFilter = [];
                        $total_question = 0;
                        for ($i = 0; $i < count($subjectFilter); $i++) {
                            foreach ($questions as $all) {
                                if ($all->subject == $subjectFilter[$i]) {
                                    $total_question++;
                                    $questionFilter[$total_question] = $all;
                                }
                            }
                            $questionPart[$i] = $questionFilter;
                        }
                    @endphp
                    @for ($i = 0; $i < count($subjectFilter); $i++)
                        <div class="question-sheet">
                            <a href="#" class="question-sheet-subject btn btn-secondary"
                                id="question-sheet-display_{{ $i + 1 }}">
                                <span>{{ $subjectFilter[$i] }}</span> <span><i
                                        class="fa-solid fa-arrow-right fa-icon_{{ $i + 1 }}"></i></span>
                            </a>
                            <div id="question-sheet-number-display_{{ $i + 1 }}" style="display: none;">
                                <div class="question-sheet-number text-center">
                                    @php
                                        $questionList = $questionPart[$i];
                                    @endphp
                                    @foreach ($questionList as $key => $value)
                                        @php
                                            if ($value->subject != $subjectFilter[$i]) {
                                                continue;
                                            }
                                        @endphp
                                        <a href="#" id="question_pallete_nav_{{ $key }}"
                                            value="{{ $key }}"
                                            class="text-white fw-bold circle">{{ $key }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endfor
                    <br>
                    <div class="unattempt d-flex">
                        <div
                            style="width: 30px; height: 30px; background-color: black; border-radius: 8px; margin-right: 4px;">
                        </div><span>Not visited question</span>
                    </div>
                    <div class="answered d-flex">
                        <div
                            style="width: 30px; height: 30px; background-color: rgb(35, 32, 223); border-radius: 8px; margin-right: 4px;">
                        </div><span>Answered questions</span>
                    </div>
                    <div class="answered d-flex">
                        <div
                            style="width: 30px; height: 30px; background-color: green; border-radius: 8px; margin-right: 4px;">
                        </div><span>Marked for review questions</span>
                    </div>
                    <div class="not-answered d-flex">
                        <div
                            style="width: 30px; height: 30px; background-color: red; border-radius: 8px; margin-right: 4px;">
                        </div><span>Not answered questions</span>
                    </div>
                    <p class="btn text-white question-close float-end d-md-none d-sm-flex"
                        style="background-color: red; dispaly: none; margin-top: 10px; margin-bottom: 10px;">Close</p>
                </div>
            </div>
            <div class="col-md-9">
                <span class="total-question-count-navigation" style="display: none"
                    value="{{ count($questionFilter) }}"></span>
                <div class="d-flex justify-content-center">

                    <div>
                        @foreach ($questionFilter as $questionNo => $value)
                            <div class="question-block-{{ $questionNo }}" style="display: none">
                                <form action="">
                                    <div>
                                        <label for="question-{{ $questionNo }}" style="font-weight: bold">( <span
                                                style="color: red;">{{ $questionNo }}</span> ) .
                                        </label>
                                        <label for="question-{{ $questionNo }}"
                                            style="font-weight: bold">{!! $value->question !!}</label>
                                    </div>
                                    <div>
                                        <label for="a-{{ $questionNo }}">(a).</label>
                                        <input type="radio" id="a-{{ $questionNo }}" name="answer-{{ $questionNo }}"
                                            value="a">&nbsp;
                                        <label for="a-{{ $questionNo }}"> {!! $value->a !!}</label><br>
                                    </div>
                                    <div>
                                        <label for="b-{{ $questionNo }}">(b).</label>
                                        <input type="radio" id="b-{{ $questionNo }}" name="answer-{{ $questionNo }}"
                                            value="b">&nbsp;
                                        <label for="b-{{ $questionNo }}"> {!! $value->b !!}</label><br>
                                    </div>
                                    <div>
                                        <label for="c-{{ $questionNo }}">(c).</label>
                                        <input type="radio" id="c-{{ $questionNo }}" name="answer-{{ $questionNo }}"
                                            value="c">&nbsp;
                                        <label for="c-{{ $questionNo }}"> {!! $value->c !!}</label><br>
                                    </div>
                                    <div>
                                        <label for="d-{{ $questionNo }}">(d).</label>
                                        <input type="radio" id="d-{{ $questionNo }}" name="answer-{{ $questionNo }}"
                                            value="d">&nbsp;
                                        <label for="d-{{ $questionNo }}"> {!! $value->d !!}</label><br>
                                    </div>
                                    @if ($value->e != '')
                                        <div>
                                            <label for="e-{{ $questionNo }}">(e).</label>
                                            <input type="radio" id="e-{{ $questionNo }}"
                                                name="answer-{{ $questionNo }}" value="e">&nbsp;
                                            <label for="e-{{ $questionNo }}"> {!! $value->e !!}</label><br>
                                        </div>
                                    @endif
                                </form>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn text-white" id="clearRadio_{{ $questionNo }}"
                                        style="background-color: rgb(9, 104, 110);">Clear</a>&nbsp;
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center" style="margin-top: 10px; margin-bottom: 10px;">
                            <a href="#" class="btn text-white mark-next-button" value=""
                                style="background-color: green">Mark &
                                Next</a>&nbsp;
                            <a href="#" class="btn text-white save-next-button" value=""
                                style="background-color: #050C9C;">Save &
                                Next</a>&nbsp;

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn text-white previous-question-button" value=""
                        style="background-color: #1A4D2E"><i class="fa-solid fa-arrow-left text-white"></i>
                        Previous
                    </a>&nbsp;
                    <a href="#" class="btn btn-primary next-question-button" value="">Next <i
                            class="fa-solid fa-arrow-right text-white"></i></a>
                </div>
                <br>
                <br>
                <br>
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn text-white" style="background-color: red;"> Cancel Test</a>
                    <button class="btn text-white submit-test" style="background-color: blue;"> Submit Test</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-and-files')
    <!-- Modal -->
    <div class="modal" id="selectAlert" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="d-flex justify-content-center">Please, Select any option.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="timeralertmodel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="d-flex justify-content-center text-danger">5 minutes left..</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{--  --}}
    <script>
        $('.question-small-screen').click(function() {
            if ($('.fa-icon-questions').hasClass('fa-arrow-right')) {
                $('.fa-icon-questions').removeClass('fa-arrow-right').addClass('fa-xmark');
            } else {
                $('.fa-icon-questions').removeClass('fa-xmark').addClass('fa-arrow-right');
            }
            $('.all-subjects-related').toggle();
        });
        $('.question-close').click(function() {
            if ($('.fa-icon-questions').hasClass('fa-arrow-right')) {
                $('.fa-icon-questions').removeClass('fa-arrow-right').addClass('fa-xmark');
            } else {
                $('.fa-icon-questions').removeClass('fa-xmark').addClass('fa-arrow-right');
            }
            $('.all-subjects-related').toggle();
        });

        $(document).on('click', "[id^=question-sheet-display_]", function() {
            var id = $(this).attr('id');
            id = id.replace("question-sheet-display_", '');
            $('#question-sheet-number-display_' + id).toggle();
            if ($('.fa-icon_' + id).hasClass('fa-arrow-right')) {
                $('.fa-icon_' + id).removeClass('fa-arrow-right').addClass('fa-chevron-down');
            } else {
                $('.fa-icon_' + id).removeClass('fa-chevron-down').addClass('fa-arrow-right');
            }
        });


        $(window).on("beforeunload", function(e) {
            return e.originalEvent.returnValue = "Changes will not be saved.";
        });
    </script>

    {{-- question navigation --}}
    <script>
        $(document).ready(function() {

            var userResponse = [];
            // question initial load
            $('.question-block-1').css('display', 'visible');
            $('#question_pallete_nav_1').css('background-color', 'red');
            $('.mark-next-button').attr('value', 2);
            $('.save-next-button').attr('value', 2);
            $('.previous-question-button').attr('value', 0);
            $('.next-question-button').attr('value', 2);
            // end question initial load
            var totalQuestion = $('.total-question-count-navigation').attr('value');
            totalQuestion = parseInt(totalQuestion);

            for (let e = 1; e <= totalQuestion; e++) {
                userResponse[e] = {
                    answer: '',
                    givenAnswer: '',
                    markForReview: '',
                    questionNo: '',
                };
            }

            $("[id^=question_pallete_nav_]").click(function() {
                var questionPallet = parseInt($(this).attr('value'));
                var previousValue = $('.previous-question-button').attr('value');
                previousValue = parseInt(previousValue);
                if (questionPallet <= parseInt(totalQuestion + 1)) {
                    if (questionPallet < parseInt(totalQuestion + 1)) {
                        $('.next-question-button').attr('value', parseInt(questionPallet + 1));
                        $('.mark-next-button').attr('value', parseInt(questionPallet + 1));
                        $('.save-next-button').attr('value', parseInt(questionPallet + 1));
                    }
                    $('.previous-question-button').attr('value', parseInt(questionPallet - 1));
                    $('.question-block-' + parseInt(previousValue + 1)).css('display', 'none');
                    $('.question-block-' + questionPallet).css('display', 'visible');

                    if (userResponse[questionPallet]['answer'] != 'yes') {
                        $('#question_pallete_nav_' + parseInt(questionPallet)).css('background-color',
                            'red');
                    }
                }
            });

            $('.mark-next-button').click(function() {
                var markNext = parseInt($(this).attr('value'));
                var selected = $("input[type='radio'][name='answer-" + parseInt(markNext - 1) +
                    "']:checked").val();

                if (selected != null) {
                    if (markNext <= parseInt(totalQuestion + 1)) {

                        if (markNext < parseInt(totalQuestion + 1)) {
                            $('.next-question-button').attr('value', parseInt(markNext + 1));
                            $('.mark-next-button').attr('value', parseInt(markNext + 1));
                            $('.save-next-button').attr('value', parseInt(markNext + 1));
                            $('.previous-question-button').attr('value', parseInt(markNext - 1));
                            $('.question-block-' + parseInt(markNext - 1)).css('display', 'none');
                            $('.question-block-' + markNext).css('display', 'visible');


                            if (userResponse[markNext]['answer'] != 'yes') {
                                $('#question_pallete_nav_' + markNext).css('background-color', 'red');
                            }

                        } else {
                            $('.next-question-button').attr('value', parseInt(markNext));
                            $('.mark-next-button').attr('value', parseInt(markNext));
                            $('.save-next-button').attr('value', parseInt(markNext));
                            $('.previous-question-button').attr('value', parseInt(markNext - 2));
                        }
                        // mark next 
                        userResponse[parseInt(markNext - 1)] = {
                            answer: 'yes',
                            givenAnswer: selected,
                            markForReview: 'yes',
                            questionNo: parseInt(markNext - 1),
                        };
                        $('#question_pallete_nav_' + parseInt(markNext - 1)).css('background-color',
                            'green');
                        // end mark next
                    }
                } else {
                    $('#selectAlert').modal('show');
                }
            });

            $('.save-next-button').click(function() {
                var saveNext = parseInt($(this).attr('value'));
                var selected = $("input[type='radio'][name='answer-" + parseInt(saveNext - 1) +
                    "']:checked").val();
                if (selected != null) {
                    if (saveNext <= parseInt(totalQuestion + 1)) {
                        if (saveNext < parseInt(totalQuestion + 1)) {
                            $('.next-question-button').attr('value', parseInt(saveNext + 1));
                            $('.mark-next-button').attr('value', parseInt(saveNext + 1));
                            $('.save-next-button').attr('value', parseInt(saveNext + 1));
                            $('.previous-question-button').attr('value', parseInt(saveNext - 1));
                            $('.question-block-' + parseInt(saveNext - 1)).css('display', 'none');
                            $('.question-block-' + saveNext).css('display', 'visible');

                            if (userResponse[saveNext]['answer'] != 'yes') {
                                $('#question_pallete_nav_' + saveNext).css('background-color', 'red');
                            }

                        } else {
                            $('.next-question-button').attr('value', parseInt(saveNext));
                            $('.mark-next-button').attr('value', parseInt(saveNext));
                            $('.save-next-button').attr('value', parseInt(saveNext));
                            $('.previous-question-button').attr('value', parseInt(saveNext - 2));
                        }
                        // save next 
                        userResponse[parseInt(saveNext - 1)] = {
                            answer: 'yes',
                            givenAnswer: selected,
                            markForReview: 'no',
                            questionNo: parseInt(saveNext - 1),
                        };
                        $('#question_pallete_nav_' + parseInt(saveNext - 1)).css('background-color',
                            'blue');
                        // end save next
                    }
                } else {
                    $('#selectAlert').modal('show');
                }

            });

            $('.next-question-button').click(function() {
                var nextQuestion = parseInt($(this).attr('value'));
                if (nextQuestion <= parseInt(totalQuestion + 1)) {
                    if (nextQuestion < parseInt(totalQuestion + 1)) {
                        $('.next-question-button').attr('value', parseInt(nextQuestion + 1));
                        $('.mark-next-button').attr('value', parseInt(nextQuestion + 1));
                        $('.save-next-button').attr('value', parseInt(nextQuestion + 1));
                        $('.previous-question-button').attr('value', parseInt(nextQuestion - 1));
                        $('.question-block-' + parseInt(nextQuestion - 1)).css('display', 'none');
                        $('.question-block-' + nextQuestion).css('display', 'visible');

                        if (userResponse[nextQuestion]['answer'] != 'yes') {
                            $('#question_pallete_nav_' + parseInt(nextQuestion)).css('background-color',
                                'red');
                        }

                    } else {
                        $('.next-question-button').attr('value', parseInt(nextQuestion));
                        $('.mark-next-button').attr('value', parseInt(nextQuestion));
                        $('.save-next-button').attr('value', parseInt(nextQuestion));
                        $('.previous-question-button').attr('value', parseInt(nextQuestion - 2));

                        if (userResponse[parseInt(nextQuestion - 1)]['answer'] != 'yes') {
                            $('#question_pallete_nav_' + parseInt(nextQuestion - 1)).css('background-color',
                                'red');
                        }

                    }
                }

            });

            $('.previous-question-button').click(function() {
                var previousQuestion = parseInt($(this).attr('value'));
                if (previousQuestion > 0) {
                    $('.previous-question-button').attr('value', parseInt(previousQuestion - 1));
                    $('.next-question-button').attr('value', parseInt(previousQuestion + 1));
                    $('.mark-next-button').attr('value', parseInt(previousQuestion + 1));
                    $('.save-next-button').attr('value', parseInt(previousQuestion + 1));

                    if (userResponse[previousQuestion]['answer'] != 'yes') {
                        $('#question_pallete_nav_' + previousQuestion).css('background-color', 'red');
                    }

                    $('.question-block-' + parseInt(previousQuestion + 1)).css('display', 'none');
                    $('.question-block-' + previousQuestion).css('display', 'visible');
                }
            });


            // clear radio button
            $("[id^=clearRadio_]").click(function() {
                var id = $(this).attr('id');
                var no = id.replace("clearRadio_", '');
                no = parseInt(no);
                if (userResponse[no]['answer'] == 'yes') {
                    userResponse[no] = {
                        answer: '',
                        givenAnswer: '',
                        markForReview: '',
                        questionNo: '',
                    };
                    $('#question_pallete_nav_' + no).css('background-color', 'red');
                }
                $("input[type='radio'][name='answer-" + no +
                    "']:checked").prop('checked', false);
            });

            // end clear radio button


            var questionArray = <?php echo json_encode($questionFilter); ?>;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $('.submit-test').click(function(e) {
                $.ajax({
                    url: '/user/exam/submit',
                    type: 'POST',
                    data: {
                        'submit_test_condition': 'submit-test-condition',
                        'question_no': totalQuestion,
                        'user_response': userResponse,
                        'question_array': questionArray,
                    },
                    success: function(response) {
                        $(window).unbind('beforeunload');
                        console.log(response.givenanswer);
                        window.onbeforeunload = null;
                        var redirectUrl = "/student/dashboard";
                        window.location.href = redirectUrl;
                    }
                });
            });

        });

        $(document).ready(function() {
            // timer
            var alerted = false;
            var counter = <?php echo json_encode($examIntro->duration); ?>;
            var second = 0;
            var interval = setInterval(function() {

                if (second == 0) {
                    second = 60;
                    counter--;
                    var h = Math.floor(counter / 60);
                    var m = counter - (h * 60);
                }
                second--;
                var s = second;
                if (counter <= 0) {
                    clearInterval(interval);
                    $('#hour').text(h);
                    $('#minute').text(0);
                    $('#second').text(0);
                    return;
                } else {
                    $('.exam-timer').css('color', 'wheat');
                    $('#hour').text(h).css('color', 'wheat');
                    $('#minute').text(m).css('color', 'wheat');
                    $('#second').text(s).css('color', 'wheat');
                }
                // alert and color change
                if (m <= 4 && h == 0) {
                    $('.timer-block').css('background-color', 'red');
                    if (alerted == false) {
                        alerted = true;
                        $('#timeralertmodel').modal('show');
                    }
                }
                // end alert and color change
            }, 1000);
            // end timer            
        });

        $(document).ready( function () {
            $(window).bind('beforeunload');
        })
    </script>
@endsection

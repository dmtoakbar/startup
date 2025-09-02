@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Questions
                <small>Edit Question</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Questions</a></li>
                <li class="active">Edit Question</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @elseif(Session::has('warning'))
            <div class="alert alert-warning">{{ Session::get('warning') }}</div>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header text-center">
                            <h3 class="box-title btn btn-primary" style="font-weight: bold">Fill detail carefully</h3>
                        </div><!-- /.box-header -->
                        <form action="{{ route('office-question-edit', $question->id) }}" role="form" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">QUESTION OF SUBJECT</p>
                                        <div class="form-group">
                                            <label for="">Question of subject<span style="color: red;">*</span></label>
                                            <select name="subject" class="form-control" required style="border: 1px solid grey;">
                                                <option value="{{$question->subject}}"> {{$question->subject}} </option>
                                                @foreach ($subject as $item)
                                                <option value="{{$item->name}}"> {{$item->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">DIRECTION FOR QUESTION</p>
                                        <div class="form-group">
                                            <label for="direction">Direction</label>
                                            <textarea class="question" name="direction" id="direction">
                                                {{$question->direction}}
                                            </textarea>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">QUESTION</p>
                                        <div class="form-group">
                                            <label for="serviceName">Question<span style="color: red;">*</span></label>
                                            <textarea class="question" name="question" required>
                                                {{$question->question}}
                                            </textarea>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">ANSWER</p>
                                        <div class="form-group">
                                            <label for="serviceName">Answer<span style="color: red;">*</span></label>
                                            <select name="answer" class="form-control" required>
                                                <option value="{{$question->answer}}">{{$question->answer}}</option>
                                                <option value="a">Option (A)</option>
                                                <option value="b">Option (B)</option>
                                                <option value="c">Option (C)</option>
                                                <option value="d">Option (D)</option>
                                                <option value="e">Option (E)</option>
                                            </select>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">EXPLAIN ANSWER</p>
                                        <div class="form-group">
                                            <label for="explain">Explain answer</label>
                                            <textarea class="description" name="description">
                                                {{$question->description}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">MARK & NEGATIVE MARK FOR QUESTION</p>
                                        <div class="row">
                                            <div class="col-xs-6">
                                             <div class="form-group">
                                                <label for="mark">Mark<span style="color: red;">*</span></label>
                                                <input type="number" name="mark" step="0.001" placeholder="Enter mark" value="{{$question->mark}}" id="mark" class="form-control" required>
                                             </div>
                                            </div>
                                            <div class="col-xs-6">
                                             <div class="form-group">
                                                <label for="negative">Negative mark<span style="color: red;">*</span></label>
                                                <input type="number" name="negative" step="0.001" id="negative" value="{{$question->negative}}" placeholder="Enter negative mark" class="form-control" required>
                                             </div>
                                            </div>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">OPTIONS FOR QUESTION ANSWER</p>
                                       <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="a">Option (A)<span style="color: red;">*</span></label>
                                                <textarea class="option" name="a" required>
                                                    {{$question->a}}
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="c">Option (C)<span style="color: red;">*</span></label>
                                                <textarea class="option" name="c" required>
                                                    {{$question->c}}
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="e">Option (E)</label>
                                                <textarea class="option" name="e">
                                                    {{$question->e}}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="b">Option (B)<span style="color: red;">*</span></label>
                                                <textarea class="option" name="b" required>
                                                    {{$question->b}}
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="d">Option (D)<span style="color: red;">*</span></label>
                                                <textarea class="option" name="d" required>
                                                    {{$question->d}}
                                                </textarea>
                                            </div>
                                        </div>
                                       </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer text-center">
                                <button type="submit" style="width: 50%; color: white; background-color: rgb(94, 13, 224);" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

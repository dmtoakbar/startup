@extends('master')
@section('body')
    <div class="container" style="margin-top: 50px; margin-bottom: 60px;">
        <div class="row my-4">
            @foreach ($testCollection as $item)
                <div class="col-lg-4">
                    <div class="card" style="margin-bottom: 20px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->sub_title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $item->test_name }}</h6>
                            <p class="card-text">{!! substr($item->description, 0, 200) !!}</p>
                            <div class="d-flex justify-content-between">
                                <span
                                    style="border-radius: 4px; background-color: blue; color: white; padding: 4px 8px;">Question:
                                    {{ $item->total_question }}</span>&nbsp;
                                <span
                                    style="border-radius: 4px; background-color: rgb(16, 116, 129); color: white; padding: 4px 8px;">Time:
                                    {{ $item->duration }}mins</span>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('user-exam-intro-first', $item->id)}}" class="card-link btn btn-primary">Take Test <i
                                        class="fa-solid fa-arrow-right text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script-and-files')
@endsection

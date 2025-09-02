@extends('master')
@section('body')
    <div class="container" style="margin-top: 80px; margin-bottom: 100px;">
        <style>
            * {
                font-family: 'Arial', sans-serif;
            }
            table > td, tr, th {
                border: 1px solid black;
            }
        </style>
        <div style="margin-top: 50px;">
            <h4>{!! Str::title($digestcontent->title) !!}</h4>
        </div>
        
        <div class="d-flex justify-content-between">
            <p>Posted At: {{ \Carbon\Carbon::parse($digestcontent->updated_at)->format('d M Y H:i A'); }}
               <span style="margin-left: 5px; marign-right: 5px;">|</span>
             Updated At: {{ \Carbon\Carbon::parse($digestcontent->updated_at)->format('d M Y H:i A'); }}
            </p>
            <button class="btn btn-sm float-end" style="border: 1px solid red;">Share: <i class="fa-solid fa-share" style="color: blue;"></i></button>
        </div>
        <div class="d-flex justify-content-between">
            <p> {{ $digestcontent->tag->name }}
                @if(!empty($digestcontent->subtag_id))
                <i class="fa-solid fa-arrow-right"></i> {{$digestcontent->subtag->name}}
              @endif
            </p>
        </div>
        {!! $digestcontent->content !!}
    </div>
@endsection
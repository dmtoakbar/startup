@extends('master')
@section('body')
    <div class="container" style="margin-top: 80px; margin-bottom: 100px;">
        <style>
            * {
                font-size: 18px;
                font-family: 'Arial', sans-serif;
            }
        </style>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td class="text-primary fw-bold">Name of Content:</td>
                <td class="text-danger">{{Str::title($jobcontent->title)}}</td>
            </tr>
            <tr>
                <td class="text-primary fw-bold">Content Date / Update:</td>
                <td>{{$jobcontent->created_at}} | {{$jobcontent->updated_at}}</td>
            </tr>
            <tr>
                <td class="text-primary fw-bold">Brief Information:</td>
                <td>{!! $jobcontent->description !!}</td>
            </tr>
            </tbody>
        </table>
        <style>
            table > td, tr, th {
                border: 1px solid black;
            }
        </style>
        <div class="orgnisation-intro" style="border: 1px solid black; padding: 20px;">
            {!! Str::title($jobcontent->organisation_intro) !!}
        </div>
        <br>
        <div class="container">
            <div class="row date-fee" style="border: 1px solid black;">
                <div class="col-6 date" style="padding: 20px; border-right: 1px solid black !important;">
                  <h5 style="color: blue; font-weight: bold; text-align: center;">Important Dates</h5>
                  {!! $jobcontent->important_dates !!}
                </div>
                <div class="fee col-6" style="padding: 20px;">
                    <h5 style="color: blue; font-weight: bold; text-align: center;">Application Fee</h5>
                    {!! $jobcontent->fee_structure !!}
                </div>
            </div>
        </div>
        <br>
        <div style="border: 1px solid black; padding: 20px;">
            {!! $jobcontent->basic_qualifaction !!}
        </div>
    </div>
@endsection
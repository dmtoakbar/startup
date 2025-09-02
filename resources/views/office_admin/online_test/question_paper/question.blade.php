@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Questions
                <small>Questions table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Questions</a></li>
                <li class="active">Questions table</li>
            </ol>
        </section>
      {{-- delete model --}}
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-center" style="font-weight: bold; color: red;" id="exampleModalLabel">Delete</h5>
                  <button style="margin-top: -6%; margin-right: -1%;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('office-question-delete')}}" method="POST">
                    @csrf
                <div class="modal-body">
                 <input type="hidden" name="id" class="delete_id">
                 <p>Are you sure, you want to delete this data ?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Yes, Delete !</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        {{-- end delete model --}}

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
                        <div class="box-header text-right">
                            <h3 class="box-title"><a href="{{route('office-questionpaper-question-add', $questionpaperfronts_id)}}" class="btn btn-primary"
                                    style="width: 100px">Add</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Subject Name</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Options</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($questions as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td>
                                        {{ $item->question }}
                                    </td>
                                    <td>
                                        <p>Answer: {{ $item->answer }}</p>
                                        <p>Explanation: {{ $item->description }}</p>
                                    </td>
                                    <td>
                                        <p>(a). {{$item->a}}</p>
                                        <p>(b). {{$item->b}}</p>
                                        <p>(c). {{$item->c}}</p>
                                        <p>(d). {{$item->d}}</p>
                                        <p>(e). {{$item->e}}</p>
                                    </td>
                                    <td class="d-block text-center">
                                      <a href="{{route('office-question-edit', $item->id)}}" class="btn btn-success">Edit</a>
                                      <a href="?delete={{$item->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Subject Name</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Options</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Users
                <small>Users table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Users</a></li>
                <li class="active">Users table</li>
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
                <form action="{{route('office-services-delete')}}" method="POST">
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
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Email Verified</th>
                                        <th>User Status</th>
                                        <th style="text-align: center">Join At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($students as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                      {{$item->mobile_number}}
                                    </td>
                                    <td class="d-block text-center">
                                      @if($item->is_otp_verified == 1)
                                          <button class="btn btn-success">Yes</button>
                                      @else
                                          <button class="btn btn-danger">No</button>
                                      @endif
                                    </td>
                                    <td class="d-block text-center">
                                      {{$item->user_status}}
                                      <br>
                                      @php
                                        $change_status = Crypt::encrypt($item->email);
                                      @endphp
                                      <a href="{{route('office-student-user-status', $change_status)}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                    </td>
                                    <td class="d-block text-center">
                                      {{$item->created_at}}
                                      <br>
                                      @php
                                      $detail = Crypt::encrypt($item);
                                      @endphp
                                      <a href="{{route('office-user-detail', $detail)}}" class="btn btn-primary" style="height: 25px; padding-top: 1px;">Detail</a>
                                    </td>
                                    <td class="d-block text-center">
                                      <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th>Sr. No.</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Mobile Number</th>
                                      <th>Email Verified</th>
                                      <th>User Status</th>
                                      <th style="text-align: center">Join At</th>
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

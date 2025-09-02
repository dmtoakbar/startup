@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Admin Users
                <small>Admin Users table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Admin Users</a></li>
                <li class="active">Admin Users table</li>
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
                <form action="{{route('office-admin-user-delete')}}" method="POST">
                    @csrf
                <div class="modal-body">
                 <input type="hidden" name="email" class="delete_id">
                 <p>Are you sure, you want to delete this user and his/her detail ?</p>
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
                            <h3 class="box-title"><a href="{{ route('office-admin-user-add') }}" class="btn btn-primary"
                                    style="width: 100px">Add</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Email Verified</th>
                                        <th>Admin Type</th>
                                        <th>Admin Status</th>
                                        <th>Department</th>
                                        <th style="text-align: center">Join At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($adminUser as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                      @php
                                          if($item->email_verified_at != null) {
                                           
                                           echo '<div style="text-align: center">
                                              <span class="btn btn-success">Yes</span>
                                              </div>';        
                                           
                                          } else {
                                            echo '<div style="text-align: center">
                                              <span class="btn btn-danger">No</span>
                                              </div>';
                                          }
                                      @endphp
                                    </td>
                                    <td class="d-block text-center">
                                      @php
                                          $detail = $adminUserDetail->firstWhere('email', $item->email);
                                      @endphp
                                      @if($detail->user_type != null)
                                          {{$detail->user_type}}
                                      @else
                                          Admin User
                                      @endif
                                      <br>
                                      @php
                                        $change_type = Crypt::encrypt($item->email);
                                      @endphp
                                      <a href="{{route('office-admin-user-type', $change_type)}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                    </td>
                                    <td class="d-block text-center">
                                      @if ($detail->user_status != null)
                                          {{$detail->user_status}}
                                      @else
                                          Not Approved
                                      @endif
                                      <br>
                                      @php
                                        $change_status = Crypt::encrypt($item->email);
                                      @endphp
                                      <a href="{{route('office-admin-user-status', $change_status)}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                    </td>
                                    <td class="d-block text-center">
                                      @if ($detail->department != null)
                                          {{$detail->department}}
                                      @else
                                          No Department
                                      @endif
                                      <br>
                                      <a href="{{route('office-admin-user-department', $change_status)}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                    </td>
                                    <td class="d-block text-center">
                                      {{$item->created_at}}
                                      <br>
                                      @php
                                       $admin_detail = Crypt::encrypt($detail);
                                       $admin_name = Crypt::encrypt($item->name);
                                      @endphp
                                      <a href="{{route('office-admin-detail', [$admin_detail, $admin_name])}}" class="btn btn-primary" style="height: 25px; padding-top: 1px;">Detail</a>
                                    </td>
                                    <td class="d-block text-center">
                                      @php
                                       $delete_user = Crypt::encrypt($item->email);
                                      @endphp
                                      <a href="?delete={{$delete_user}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th>Sr. No.</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Email Verified</th>
                                      <th>Admin Type</th>
                                      <th>Admin Status</th>
                                      <th>Department</th>
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

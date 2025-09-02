@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Services
                <small>Services table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Services</a></li>
                <li class="active">Services table</li>
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

        {{-- status model --}}
        <div class="modal fade" id="StatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-center" style="color: blue;" id="exampleModalLabel">Change Status</h4>
                <button style="margin-top: -6%; margin-right: -1%;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('office-services-change-status')}}" method="POST">
                  @csrf
              <div class="modal-body">
               <input type="hidden" name="id" class="status_id">
                <div class="form-group">
                  <label for="status">Change status:</label>
                   <select name="status" class="form-control" required>
                      <option selected disabled value="">Choose an option</option>
                      <option value="Approved">Approve</option>
                      <option value="Disapproved">Disapprove</option>
                  </select>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      {{-- end status model --}}

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
                            <h3 class="box-title"><a href="{{ route('office-services-add') }}" class="btn btn-primary"
                                    style="width: 100px">Add</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th style="text-align: center;">Sr. No.</th>
                                      <th style="text-align: center;">Service Name</th>
                                      <th style="text-align: center;">Status</th>
                                      <th style="text-align: center;">Created At</th>
                                      <th style="text-align: center;">Updated At</th>
                                      <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($service as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td style="text-align: center;">{{$n}}</td>
                                    <td style="text-align: center;">{{$item->name}}</td>
                                    <td style="text-align: center;">
                                      {{$item->status}}
                                      <br>
                                      <a href="?status={{$item->id}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                    </td>
                                    <td style="text-align: center;">{{$item->created_at}}</td>
                                    <td style="text-align: center;">{{$item->updated_at}}</td>
                                    <td class="d-block text-center">
                                      <a href="{{route('office-services-edit', $item->id)}}" class="btn btn-success">Edit</a>
                                      <a href="?delete={{$item->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">Sr. No.</th>
                                        <th style="text-align: center;">Service Name</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Created At</th>
                                        <th style="text-align: center;">Updated At</th>
                                        <th style="text-align: center;">Action</th>
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
@section('footer-scripts')
@endsection

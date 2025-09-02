@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Job Contents
                <small>Job Contents table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Job Contents</a></li>
                <li class="active">Job Contents table</li>
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
                <form action="{{route('office-job-content-delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
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
                <form action="{{route('office-job-content-status')}}" method="POST">
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
                            <h3 class="box-title"><a href="{{route('office-job-content-add')}}" class="btn btn-primary"
                                    style="width: 100px">Add</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Job Tag</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                        <th>Copy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($jobcontent as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$item->jobtag->name}}</td>
                                    <td>
                                      {{substr($item->title, 0, 40)}}
                                    </td>
                                    <td class="d-block text-center">
                                        {{$item->status}}
                                        <br>
                                        <a href="?status={{$item->id}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                        <br>
                                        @php
                                            $slug = Str::slug($item->title);
                                        @endphp
                                        <a href="{{route('office-job-content-preview', ['id' => $item->id, 'title' => $slug])}}" class="btn btn-success" style="height: 25px; padding-top: 1px; margin-top: 8px;">Preview</a>
                                      </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td class="d-block text-center">
                                      <a href="{{route('office-job-content-edit', $item->id)}}" style="height: 30px; padding-top: 4px;" class="btn btn-success">Edit</a>
                                      <br>
                                      <a href="?delete={{$item->id}}" class="btn btn-danger" style="height: 30px; padding-top: 4px; margin-top: 8px;">Delete</a>
                                    </td>
                                    <td class="text-center">
                                      <a href="{{route('office-job-content-copy', $item->id)}}" class="btn btn-primary btn-sm" style="height: 30px; padding-top: 4px;">Copy</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Job Tag</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                        <th>Copy</th>
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


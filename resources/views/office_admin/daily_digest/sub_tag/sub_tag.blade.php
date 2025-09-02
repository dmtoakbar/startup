@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sub Tags
                <small>Sub Tags table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Sub Tags</a></li>
                <li class="active">Sub Tags table</li>
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
                <form action="{{route('office-sub-tag-delete')}}" method="POST">
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
                <form action="{{route('office-sub-tag-status')}}" method="POST">
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


        {{-- add model --}}
           <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-center" style="color: blue;" id="exampleModalLabel">Add</h4>
                  <button style="margin-top: -6%; margin-right: -1%;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('office-digest-sub-tag-add-and-edit')}}" method="POST">
                    @csrf
                    @method('POST')
                <div class="modal-body">
                  <?php 
                   $tag = DB::table('tags')->get();
                  ?>
                  <div class="form-group">
                    <label for="">Tag name</label>
                    <select name="tag_id" id="" class="form-control" required>
                      <option value="" selected disabled>Choose a tag</option>
                      @foreach ($tag as $tagObject)
                      <option value="{{$tagObject->id}}">{{$tagObject->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tag">Sub tag name:</label>
                     <input type="text" name="name" class="form-control" placeholder="Enter sub tag name" required>
                 </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        {{-- end add model --}}

         {{-- edit model --}}
         <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-center" style="color: blue;" id="exampleModalLabel">Edit</h4>
                <button style="margin-top: -6%; margin-right: -1%;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('office-digest-sub-tag-add-and-edit')}}" method="POST">
                  <?php 
                  if(isset($_GET['edit'])) {
                    $update = \App\Models\Subtag::where('id', trim($_GET['edit']))->first();
                    if($update != null) {
                      ?>
                      @csrf
                      @method('PUT')
                      <div class="modal-body">
                        <input type="hidden" name="id" value="{{$update->id}}">
                        <div class="form-group">
                          <label for="">Tag name</label>
                          <select name="tag_id" id="" class="form-control" required>
                            <option value="{{$update->tag_id}}">{{$update->tag->name}}</option>
                            @foreach ($tag as $tagObject)
                            <option value="{{$tagObject->id}}">{{$tagObject->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tag">Sub tag name:</label>
                           <input type="text" name="name" class="form-control" value="{{$update->name}}" placeholder="Enter sub tag name" required>
                       </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    <?php
                    }
                  }
                  ?>
              </form>
            </div>
          </div>
        </div>
      {{-- end edit model --}}

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
                            <h3 class="box-title"><a href="?add" class="btn btn-primary"
                                    style="width: 100px">Add</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Tag Name</th>
                                        <th>Sub Tag Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($subTag as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$item->tag->name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="d-block text-center">
                                        {{$item->status}}
                                        <br>
                                        <a href="?status={{$item->id}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                      </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td class="d-block text-center">
                                      <a href="?edit={{$item->id}}" class="btn btn-success">Edit</a>
                                      <a href="?delete={{$item->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th>Sr. No.</th>
                                      <th>Tag Name</th>
                                      <th>Sub Tag Name</th>
                                      <th>Status</th>
                                      <th>Created At</th>
                                      <th>Updated At</th>
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

@section('footer-scripts')
<?php
if(isset($_GET['add'])) {
?>
<script>
    $(document).ready(function() {
        $('#AddModal').modal('show');  
    });
</script>
<?php
}
?>

<?php
if(isset($_GET['edit'])) {
?>
<script>
    $(document).ready(function() {
        $('#EditModal').modal('show');  
    });
</script>
<?php
}
?>

@endsection

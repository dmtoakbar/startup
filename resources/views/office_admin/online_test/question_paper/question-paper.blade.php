@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Question Papers
                <small>Question papers table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Question papers</a></li>
                <li class="active">Question papers table</li>
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
                <form action="{{route('office-questionpaper-delete')}}" method="POST">
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
              <form action="{{route('office-questionpaper-status')}}" method="POST">
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

       {{-- set payment model --}}
       <div class="modal fade" id="SetPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center" style="color: blue;" id="exampleModalLabel">Set Payment</h4>
              <button style="margin-top: -6%; margin-right: -1%;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('office-questionpaper-set-payment')}}" method="POST">
                @csrf
            <div class="modal-body">
             <input type="hidden" name="id" class="payment_id">
              <div class="form-group">
                <label for="status">Set Payment:</label>
                 <select name="payment" class="form-control" required>
                    <option selected disabled value="">Choose an option</option>
                    <?php
                     $all_payment = DB::table('paymentsetups')->get();
                    ?>
                    @foreach ($all_payment as $data)
                    <option value="{{$data->id}}">Name : {{$data->name}}, Price : {{$data->price}}, Discount: {{$data->normal_discount}}</option>
                    @endforeach 
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
                            <h3 class="box-title"><a href="{{ route('office-questionpaper-add') }}" class="btn btn-primary"
                                    style="width: 100px">Add</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Test</th>
                                        <th>Paper</th>
                                        <th>Status</th>
                                        <th>Set Payment</th>
                                        <th>Created At</th>
                                        <th>Question</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($all as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$item->test_name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="d-block text-center">
                                      {{$item->status}}
                                      <br>
                                      <a href="?status={{$item->id}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                    </td>
                                    <td class="d-block text-center">

                                      <?php
                                          if($item->payment_id != null) {
                                            $get_payment_name = DB::table('paymentsetups')->where('id', $item->payment_id)->first();
                                             echo ("₹".$get_payment_name->price);
                                          } else {
                                            echo "Not Set";
                                          }
                                      ?>
                                      <br>
                                      <a href="?set-payment={{$item->id}}" class="btn btn-warning" style="height: 25px; padding-top: 1px;">Change</a>
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="text-center">
                                      <button class="btn" style="background-color: rgb(39, 32, 32); color: white;">
                                        @php
                                            $q_no = 0;
                                        @endphp
                                        @if(DB::table('questionpapers')->where('questionpaperfronts_id', $item->id)->exists())
                                        @foreach ($question as $que)
                                            @if ($que->questionpaperfronts_id == $item->id)
                                                @php
                                                    $q_no++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @endif
                                        {{$q_no}} Q
                                      </button>
                                      <a href="{{route('office-questionpaper-question-add', $item->id)}}" class="btn btn-primary">Add</a>
                                      <a href="{{route('office-questionpaper-question', $item->id)}}" class="btn btn-warning">View</a>
                                    </td>
                                    <td class="d-block text-center">
                                      <a href="{{route('office-questionpaper-edit', $item->id)}}" class="btn btn-success">Edit</a>
                                      <a href="?delete={{$item->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th>Sr. No.</th>
                                      <th>Test</th>
                                      <th>Paper</th>
                                      <th>Status</th>
                                      <th>Set Payment</th>
                                      <th>Created At</th>
                                      <th>Question</th>
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
if(request()->get('set-payment') != null) {
?>
<script>
    $(document).ready(function() {
      var paymentID = {{ Js::from(request()->get('set-payment')) }};
      $('.payment_id').val(paymentID);
        $('#SetPaymentModal').modal('show');  
    });
</script>
<?php
}
?>
@endsection

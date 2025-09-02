@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Payment Setups
                <small>Payment Setups table</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Payment Setups</a></li>
                <li class="active">Payment Setups table</li>
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
                <form action="{{route('office-payment-delete')}}" method="POST">
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


          {{-- coupon model --}}
          <div class="modal fade" id="CouponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-center" style="color: blue;" id="exampleModalLabel">Add Coupon code</h4>
                  <button style="margin-top: -6%; margin-right: -1%;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                if(request()->get('coupon') != null ) {
                  $get = $payment->first(function($value){
                    return $value->id == request()->get('coupon');
                  });
                  if($get != null) {
                    ?>
                    <form action="{{route('office-payment-coupon')}}" method="POST">
                        @csrf
                    <div class="modal-body">
                     <input type="hidden" name="id" value="{{$get->id}}">

                     <?php
                      if($get->coupon != null & $get->coupon != 'null') {
                        $get_array = json_decode($get->coupon, true);
                        $getAssociativeArray = [];
                      foreach ($get_array as $datas) {
                        $getAssociativeArray = array_merge($getAssociativeArray, $datas);
                      }
                      
                      $c_form = 0;
                      foreach ($getAssociativeArray  as $keys => $values) {
                       $c_form++;
                       ?>
                         <div class="row couponRow couponrow_{{$c_form}}" >
                          <div class="col-xs-6">
                          <div class="form-group">
                            <label for="coupon">Coupon code</label>
                          <input type="text" name="coupon[]" placeholder="Enter coupon" value="{{$keys}}" class="form-control" required>
                          </div>
                          </div>
                          <div class="col-xs-6">
                          <div class="form-group">
                            <label for="discount">Discount(%)</label><span class="pull-right" id="couponrow_{{$c_form}}" style="font-size: 20px; height: 20px; font-weight: bolder; color: rgb(235, 8, 8); cursor: pointer; ">×</span>
                            <input type="number" name="discount[]" step="0.0001" value="{{$values}}" placeholder="Enter discount %" class="form-control" required>
                          </div>
                          </div>
                        </div>
                      <?php
                      }
                      } else {
                        ?>
                        <div class="row couponRow couponrow_1" >
                          <div class="col-xs-6">
                          <div class="form-group">
                            <label for="coupon">Coupon code</label>
                          <input type="text" name="coupon[]" placeholder="Enter coupon" class="form-control" required>
                          </div>
                          </div>
                          <div class="col-xs-6">
                          <div class="form-group">
                            <label for="discount">Discount(%)</label><span class="pull-right" id="couponrow_1" style="font-size: 20px; height: 20px; font-weight: bolder; color: rgb(235, 8, 8); cursor: pointer; ">×</span>
                            <input type="number" name="discount[]" step="0.0001" placeholder="Enter discount %" class="form-control" required>
                          </div>
                          </div>
                        </div>
                      <?php
                      }
                      ?>
                        <div class="row-place-in"></div>
                        <p class="btn btn-sm btn-success addMoreRow">More +</p>
                    </div>
                    <?php
                  } else {
                    ?>
                     <form action="#" method="GET">
                      @csrf
                    <div class="modal-body">
                    
                    </div>
                    <?php
                  }
                }      
              ?>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        {{-- end coupon model --}}
       
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
                            <h3 class="box-title"><a href="{{ route('office-payment-add') }}" class="btn btn-primary"
                                    style="width: 100px">Add</a></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th>Sr. No.</th>
                                      <th>Payment Name</th>
                                      <th>Price Per Item</th>
                                      <th>Normal Discount</th>
                                      <th>Coupon Code For Discount</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                      $n = 0;
                                  @endphp
                                  @foreach ($payment as $item)
                                  @php
                                      $n++;
                                  @endphp
                                  <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="d-block text-center">
                                        {{$item->price}}
                                    </td>
                                    <td  class="text-center">
                                        {{$item->normal_discount}}%
                                    </td>
                                    <th>
                                    <style>
                                        .tooltip-container {
                                          position: relative;
                                          display: inline-block;
                                        }
                                      .tooltip-container .tooltip-container-text {
                                        visibility: hidden;
                                        width: 140px;
                                        background-color: #555;
                                        color: #fff;
                                        text-align: center;
                                        border-radius: 6px;
                                        padding: 5px;
                                        position: absolute;
                                        z-index: 1;
                                        bottom: 150%;
                                        left: 50%;
                                        margin-left: -75px;
                                        opacity: 0;
                                        transition: opacity 0.3s;
                                      }
                                      
                                      .tooltip-container .tooltip-container-text::after {
                                        content: "";
                                        position: absolute;
                                        top: 100%;
                                        left: 50%;
                                        margin-left: -5px;
                                        border-width: 5px;
                                        border-style: solid;
                                        border-color: #555 transparent transparent transparent;
                                      }
                                      
                                      .tooltip-container:hover .tooltip-container-text {
                                        visibility: visible;
                                        opacity: 1;
                                      }
                                      </style>
                                        <?php
                                            if($item->coupon != null & $item->coupon != 'null') {
                                             $array = json_decode($item->coupon, true);
                                             $associativeArray = [];
                                            foreach ($array as $data) {
                                                $associativeArray = array_merge($associativeArray, $data);
                                            }
                                            
                                            foreach ($associativeArray  as $key => $value) {
                                              $c = mt_rand(100000,999999);
                                            ?>
                                            <div class="tooltip-container" id="tooltip-container_{{$c}}" style="margin-bottom: 5px;">
                                              <button>
                                                <span class="tooltip-container-text" id="myTooltip_{{$c}}">Copy to clipboard</span>
                                                 <span id="tooltip_code_{{$c}}">{{$key}}</span> : {{$value}}%
                                                </button>
                                              </div>
                                            <?php
                                            }
                                            }
                                            ?>
                                            <br>
                                        <a href="?coupon={{$item->id}}" class="btn btn-warning" style="height: 25px; padding-top: 1px; margin-top: 8px;">Add</a>
                                    </th>
                                    <td>{{$item->created_at}}</td>
                                    <td class="d-block text-center">
                                      <a href="{{route('office-payment-edit', $item->id)}}" class="btn btn-success" style="margin-bottom: 5px;">Edit</a>
                                      <a href="?delete={{$item->id}}" class="btn btn-danger" style="margin-bottom: 5px;">Delete</a>
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th>Sr. No.</th>
                                      <th>Payment Name</th>
                                      <th>Price Per Item</th>
                                      <th>Normal Discount</th>
                                      <th>Coupon Code For Discount</th>
                                      <th>Created At</th>
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
if(request()->get('coupon') != null) {
?>
<script>
    $(document).ready(function() {
        $('#CouponModal').modal('show');  
    });
</script>
<?php
}
?>

<script>
  $(document).ready(function() {
    $('.addMoreRow').on('click', function(e){
     var length = $('.couponRow').length;
     var increaseLength = length +1;
      $('.row-place-in').append('<div class="row couponRow couponrow_'+ increaseLength +'"><div class="col-xs-6"><div class="form-group"><label for="coupon">Coupon code</label><input type="text" name="coupon[]" placeholder="Enter coupon" class="form-control" required></div></div><div class="col-xs-6"><div class="form-group"><label for="discount">Discount(%)</label><span class="pull-right" id="couponrow_'+ increaseLength +'" style="font-size: 20px; height: 20px; font-weight: bolder; color: rgb(235, 8, 8); cursor: pointer; ">×</span><input type="number" name="discount[]" step="0.0001" placeholder="Enter discount %" class="form-control" required></div></div></div>');
    });

    $(document).on('click', "[id^=couponrow_]", function(){
		 var id = $(this).attr('id');
     $('div.'+id).remove();
	 });

   var ids=0;

   $(document).on('click', "[id^=tooltip-container_]", function(){
		 var orginalId = $(this).attr('id');
     ids = orginalId.replace('tooltip-container_', '');
     var value = $('#tooltip_code_'+ids).text();
     navigator.clipboard.writeText('');
     navigator.clipboard.writeText(value);
     $('#myTooltip_'+ids).text("Copied: " + value);
	 });

  });
</script>
@endsection

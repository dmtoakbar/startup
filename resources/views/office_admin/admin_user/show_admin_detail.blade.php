@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Admin User Details
                <small>Admin User Detail</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Admin User Details</a></li>
                <li class="active">Admin User Detail</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header text-center">
                            <h3 class="box-title">Admin User Detail</h3>
                        </div><!-- /.box-header -->
                       <div class="row" style="margin-top: 10px;">
                        <div class="col-md-10 col-md-offset-1">
                             <div style="text-align: center; display: flex; justify-content: center; margin-bottom: 25px;">
                                <div class="pull-center image">
                                   @if ($detail->profile_img != null )
                                   <img src="/admin_profile_img/{{$detail->profile_img}}" height="80" class="img-circle" alt="User Image" />
                                   @else
                                   <img src="/admin_assets/dist/img/user2-160x160.jpg"  class="img-circle" alt="User Image" />
                                   @endif
                               </div>
                                </div>
                            <div style="text-align: center; display: flex; justify-content: space-between;">
                                <p style="background-color: rgb(92, 155, 226); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><Strong>Name:</Strong> {{$name}}</p>
                                    <p style="background-color: rgb(235, 92, 10); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><Strong>Last Updated:</Strong> {{$detail->updated_at}}</p>
                             </div>
                             <div style="text-align: center; display: flex; justify-content: center;">
                                    <p style="background-color: rgb(67, 71, 9); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><Strong>Email:</Strong> {{$detail->email}}</p>
                             </div>
                             <div style="text-align: center; display: flex; justify-content: space-between;">
                                <p style="background-color: rgb(59, 59, 88); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><strong>Mobile Number:</strong> {{$detail->mobile_number}}</p>
                                    <p style="background-color: rgb(128, 0, 122); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><strong>Alternate Mobile Number: </strong> {{$detail->alternate_mobile_number}}</p>
                             </div>
                             <div style="text-align: center; display: flex; justify-content: space-between;">
                                <p style="background-color: rgb(194, 15, 83); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><strong>Department: </strong> {{$detail->department}}</p>
                                    <p style="background-color: rgb(7, 58, 32); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><strong>Admin Status: </strong> 
                                     @php
                                         if($detail->user_status == null) {
                                            echo 'Not Approved';
                                         } else {
                                            echo $detail->user_status;
                                         }
                                     @endphp
                                    </p>
                             </div>
                            <div style="text-align: center; display: flex; justify-content: center;">
                                <p style="background-color: blueviolet; color: white; padding: 10px; border-radius: 8px;"><strong>Address:</strong> {{$detail->address}}</p>
                             </div>
                             <div style="display: flex; justify-content: space-between;">
                                <p style="background-color: rgb(9, 0, 128); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><Strong>Join At:</Strong> {{$detail->created_at}}</p>
                                <p style="background-color: rgb(7, 19, 24); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><strong>Last Login IP: </strong> {{$detail->last_login_ip}}</p>
                              </div>
                              <div style="display: flex; justify-content: space-between;">
                                <p style="background-color: green; border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><strong>Last Login Time: </strong> {{$detail->last_login_time}}</p>
                                <p style="background-color: rgb(241, 13, 5); border-radius: 4px; color: white; padding: 8px; font-size: 18px; margin: 10px;"><strong>Last Logout Time: </strong> {{$detail->last_log_out_time}}</p>
                              </div>
                        </div>
                       </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

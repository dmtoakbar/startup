@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User Details
                <small>User Detail</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">User Details</a></li>
                <li class="active">User Detail</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header text-center">
                            <h3 class="box-title">User Detail</h3>
                        </div><!-- /.box-header -->
                       <div class="row" style="margin-top: 10px;">
                            <div class="col-md-10 col-md-offset-1">
                                <!------------- user image --------------->
                                <div style="text-align: center; display: flex; justify-content: center; margin-bottom: 25px;">
                                    <div class="pull-center image">
                                    @if ($detail->profile_img != null )
                                    <img src="/user_profile_img/{{$detail->image}}" height="80" class="img-circle" alt="User Image" />
                                    @else
                                    <img src="/admin_assets/dist/img/user2-160x160.jpg"  class="img-circle" alt="User Image" />
                                    @endif
                                    </div>
                                </div>
                                <!--------------- end user image ------------------->
                            </div>
                        </div>
                        <!------------- user detail -------------------------->
                        <div class="row">
                          
                        </div>
                        <!-------------- end user detail ------------------------->   
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

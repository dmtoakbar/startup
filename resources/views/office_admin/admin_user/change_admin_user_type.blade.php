@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Admin User Type
                <small>Change Admin User Type</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Admin User Type</a></li>
                <li class="active">Change Admin User Type</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header text-center">
                            <h3 class="box-title">Fill Details Carefully</h3>
                        </div><!-- /.box-header -->
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">

                                <form action="{{ route('office-admin-user-type') }}" role="form" method="POST">
                                    @csrf
                                    <div class="box-body">
                                        <input type="hidden" name="email" value="{{$email}}">
                                        <div class="form-group">
                                            <label for="serviceName">Change admin type:</label>
                                               <select name="type_change" id="" class="form-control" required>
                                                <option selected disabled value="">Choose an option</option>
                                                <option value="Super Admin User">Super Admin User</option>
                                                <option value="Major Admin User">Major Admin User</option>
                                                <option value="Admin User">Admin User</option>
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

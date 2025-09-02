@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tests
                <small>Add Test</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tests</a></li>
                <li class="active">Add Test</li>
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

                                <form action="{{ route('office-tests-add') }}" role="form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="serviceName">Test Name:</label>
                                            <input type="text" class="form-control" name="testName"
                                                placeholder="Test name" required 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="describe">Describe:</label>
                                            <textarea name="description" id="describe" cols="30" rows="10" class="form-control" placeholder="Enter a few line about test" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="img">Feature image:</label>
                                            <input type="file" name="img" id="img" class="form-control" required>
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

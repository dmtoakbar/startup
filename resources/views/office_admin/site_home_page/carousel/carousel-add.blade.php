@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Carousels
                <small>Add Carousel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Carousels</a></li>
                <li class="active">Add Carousel</li>
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

                                <form action="{{ route('office-site-home-page-carousel-add') }}" role="form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="serviceName">Title:</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Title" required 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Short Decription:</label>
                                            <input type="text" class="form-control" name="describe"
                                                placeholder="Short description" required 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Link:</label>
                                            <input type="text" class="form-control" name="link"
                                                placeholder="Link" required 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Image:</label>
                                            <input type="file" class="form-control" name="image" required 
                                                style="border: 1px solid grey;"
                                                >
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

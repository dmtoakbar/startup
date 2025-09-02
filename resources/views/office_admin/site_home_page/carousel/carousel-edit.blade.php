@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Carousels
                <small>Edit Carousel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Carousels</a></li>
                <li class="active">Edit Carousel</li>
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

                                <form action="{{ route('office-site-home-page-carousel-edit', $carousel->id) }}" role="form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="serviceName">Title:</label>
                                            <input type="text" class="form-control" value="{{$carousel->title}}" name="title"
                                                placeholder="Title" required 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Short Decription:</label>
                                            <input type="text" class="form-control" value="{{$carousel->describe}}" name="describe"
                                                placeholder="Short description" required 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Link:</label>
                                            <input type="text" class="form-control" value="{{$carousel->link}}" name="link"
                                                placeholder="Link" required 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Image:</label>
                                            <input type="file" class="form-control" name="image" 
                                                style="border: 1px solid grey;"
                                                >
                                        </div>
                                        <img src="/image/carousel/{{$carousel->image}}" style="width: 100%" height="150" alt="">
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

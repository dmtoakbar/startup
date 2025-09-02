@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Question Papers
                <small>Edit Question Paper</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Question Papers</a></li>
                <li class="active">Edit Question Paper</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header text-center">
                            <h3 class="box-title">Edit Details Carefully</h3>
                        </div><!-- /.box-header -->
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">

                                <form action="{{ route('office-questionpaper-edit', $qpf[0]->id) }}" role="form" method="POST">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="">Test Name:</label>
                                            <select name="testName" class="form-control" required style="border: 1px solid grey;">
                                                <option value="{{$qpf[0]->test_name}}"> {{$qpf[0]->test_name}} </option>
                                                @foreach ($qpf[1] as $item)
                                                <option value="{{$item->name}}"> {{$item->name}} </option>
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Question Paper Name:</label>
                                            <input type="text" class="form-control" value="{{$qpf[0]->name}}" name="qpfName"
                                                placeholder="Question paper name" required style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Question Paper Sub Name:</label>
                                            <input type="text" class="form-control" name="subName" value="{{$qpf[0]->sub_title}}"
                                                placeholder="Question paper sub name" required style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Total Question:</label>
                                            <input type="number" step="0.01" value="{{$qpf[0]->total_question}}" class="form-control" name="totalquestion"
                                                placeholder="Total question" required style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Total Number:</label>
                                            <input type="number" step="0.01" value="{{$qpf[0]->total_number}}" class="form-control" name="totalnumber"
                                                placeholder="Total number" required style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Minus Per Wrong Question:</label>
                                            <input type="text" class="form-control" name="minusNumber" value="{{$qpf[0]->minus_per_wrong_question}}"
                                                placeholder="Minus per wrong question" required style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Paper Duration(mins):</label>
                                            <input type="number" step="0.01" value="{{$qpf[0]->duration}}" class="form-control" name="duration"
                                                placeholder="Paper duration" required style="border: 1px solid grey;">
                                        </div>
                                        <div class="form-group">
                                            <label for="serviceName">Detail Description:</label>
                                            <textarea class="summernote" name="description" required>{{$qpf[0]->description}}</textarea>
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

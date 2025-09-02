@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Job Content
                <small>Edit Job Content</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Job Content</a></li>
                <li class="active">Edit Job Content</li>
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
                        <style>
                            input {
                                border: 1px solid black !important;
                            }
                            select {
                                border: 1px solid black !important;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <form action="{{ route('office-job-content-edit') }}" role="form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <input type="hidden" name="id" value="{{$jobcontent->id}}">
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Title</p>
                                        <div class="form-group">
                                            <label for="">Title<span>*</span></label>
                                            <input type="text" name="title" class="form-control" value="{{$jobcontent->title}}" placeholder="Enter content title" required>
                                            <small class="text-danger">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @php
                                                $jobtags = \App\Models\Jobtag::all();
                                                @endphp
                                                <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Job Tag</p>
                                                <div class="form-group">
                                                    <label for="">Job Tag<span>*</span></label>
                                                    <select name="tag" id="tagItems" class="form-control" required>
                                                        <option value="{{$jobcontent->jobtag_id}}">{{$jobcontent->jobtag->name}}</option>
                                                        @foreach ($jobtags as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="text-danger">
                                                        @error('tag')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                                <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Orgnisation Title & Intro</p>
                                                <div class="form-group">
                                                    <label>Orgnisation Title & Intro<span>*</span></label>
                                                    <textarea class="jobDescriptionIntro" name="orgnisation_intro" required>{{$jobcontent->organisation_intro}}</textarea>
                                                    <small class="text-danger">
                                                        @error('orgnisation_intro')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                                <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Important Dates</p>
                                                <div class="form-group">
                                                    <label>Important Dates<span>*</span></label>
                                                    <textarea class="dateAndFee" name="important_dates" required>{{$jobcontent->important_dates}}</textarea>
                                                    <small class="text-danger">
                                                        @error('important_dates')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Description</p>
                                                <div class="form-group">
                                                    <label>Description<span>*</span></label>
                                                    <textarea class="jobDescription" name="description" required>{{$jobcontent->description}}</textarea>
                                                    <small class="text-danger">
                                                        @error('description')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                                <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Fee Structure</p>
                                                <div class="form-group">
                                                    <label>Fee Structure<span>*</span></label>
                                                    <textarea class="dateAndFee" name="fee_structure" required>{{$jobcontent->fee_structure}}</textarea>
                                                    <small class="text-danger">
                                                        @error('fee_structure')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Basic Qualification Requirement</p>
                                        <div class="form-group">
                                            <label>Basic Qualification Requirement<span>*</span></label>
                                            <textarea class="dateAndFee" name="basic_qualifaction" required>{{$jobcontent->basic_qualifaction}}</textarea>
                                            <small class="text-danger">
                                                @error('basic_qualifaction')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Job Detail</p>
                                        <div class="form-group">
                                            <label>Job Detail<span>*</span></label>
                                            <textarea class="jobDetail" name="detail_first" required>{{$jobcontent->detail_first}}</textarea>
                                            <span class="btn btn-sm btn-primary" id="detailFirst" style="display: <?php if($jobcontent->detail_second == null || $jobcontent->detail_second == "") { ?> inline-block; <?php } else { ?> none; <?php } ?>">Add more +</span>
                                        </div>
                                        <small class="text-danger">
                                            @error('detail_first')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                        <div id="hideDetailSecond" style="display: <?php if($jobcontent->detail_second == null || $jobcontent->detail_second == "") { ?> none; <?php } else { ?> block; <?php } ?>">
                                            <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Job Detail</p>
                                            <div class="form-group">
                                                <label>Job Detail</label>
                                                <textarea class="jobDetail" name="detail_second">{{$jobcontent->detail_second}}</textarea>
                                                <div class="d-flex justify-content-between" style="display: flex; justify-content: space-between;">
                                                    <span class="btn btn-sm btn-primary" id="detailSecond" style="display: <?php if($jobcontent->detail_third == null || $jobcontent->detail_third == "") { ?> inline-block; <?php } else { ?> none; <?php } ?>">Add more +</span>
                                                    <span class="btn btn-sm btn-danger float-left" id="detailSecondRemove" style="display: <?php if($jobcontent->detail_third == null || $jobcontent->detail_third == "") { ?> inline-block; <?php } else { ?> none; <?php } ?>">Remove</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="hideDetailThird" style="display: <?php if($jobcontent->detail_third == null || $jobcontent->detail_third == "") { ?> none; <?php } else { ?> block; <?php } ?>">
                                            <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Job Detail</p>
                                            <div class="form-group">
                                                <label>Job Detail</label>
                                                <textarea class="jobDetail" name="detail_third">{{$jobcontent->detail_third}}</textarea>
                                                <div class="d-flex justify-content-between" style="display: flex; justify-content: space-between;">
                                                    <span class="btn btn-sm btn-danger float-end" id="detailThirdRemove">Remove</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-center" style="color: white; font-size: 16px; font-weight: bold; width: 100%; background-color: blue;">Important Links</p>
                                        <?php
                                          $raw = json_decode($jobcontent->important_links, true);
                                          $rowcount = 0;
                                          foreach ($raw as $values) {
                                             $rowcount++;
                                        ?>
                                        <div class="row importantLink_{{$rowcount}} countLink">
                                            <div class="col-md-4">
                                             <div class="form-group">
                                                <label for="">Title For Link</label>
                                             <input type="text" name="link_title[]" value="{{$values[0]}}" class="form-control" placeholder="Enter title for link" required>
                                             </div>
                                            </div>
                                            <div class="col-md-4">
                                             <div class="form-group">
                                                <label for="">Link Name</label>
                                                <input type="text" name="link_name[]" value="{{$values[1]}}" class="form-control" placeholder="Enter link name" required>
                                             </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Link (URL)</label><span class="pull-right" id='importantLink_{{$rowcount}}' style="font-size: 20px; height: 20px; font-weight: bolder; color: rgb(235, 8, 8); cursor: pointer; ">×</span>
                                                    <input type="text" name="link[]" value="{{$values[2]}}" class="form-control" placeholder="Enter url" required>
                                                 </div>
                                             </div>
                                        </div>
                                        <?php
                                          }
                                        ?>
                                        <div class="add_link_here"></div>
                                        <span class="btn btn-sm btn-primary addMoreLink">Add more link+</span>

                                        
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

@section('footer-scripts')
<script>
    $(document).ready( function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
        });

       $('.jobDescription').summernote({
                height: 258,
                minHeight: null,
                maxHeight: null,
                focus: false
        });
        $('.jobDescriptionIntro').summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: false
        });
        $('.dateAndFee').summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: false
        });

       $('.jobDetail').summernote({
                height: 250,
                minHeight: null,
                maxHeight: null,
                focus: false
        });
        const addDetailFirst = document.getElementById('detailFirst');
        const visibleSecondDetail = document.getElementById('hideDetailSecond');
        const detailSecondRemove = document.getElementById('detailSecondRemove');
        const visibleThirdDetail = document.getElementById('hideDetailThird');
        const addDetailSecond = document.getElementById('detailSecond');
         $('#detailFirst').on('click', function() {
            visibleSecondDetail.style.display = 'block';
            addDetailFirst.style.display = 'none';
         });
         $('#detailSecondRemove').on('click', function() {
            visibleSecondDetail.style.display = 'none';
            addDetailFirst.style.display = 'inline-block';

         });
         $('#detailSecond').on('click', function() {
           visibleThirdDetail.style.display = 'block';
           addDetailSecond.style.display = 'none';
           detailSecondRemove.style.display = 'none';
         });
         $('#detailThirdRemove').on('click', function() {
            visibleThirdDetail.style.display = 'none';
            addDetailSecond.style.display = 'inline-block';
            detailSecondRemove.style.display = 'inline-block';

         });



         $('.addMoreLink').on('click', function(e){
        var length = $('.countLink').length;
        var increaseLength = length +1;
        $('.add_link_here').append('<div class="row importantLink_'+increaseLength+' countLink"> <div class="col-md-4"> <div class="form-group"><label for="">Title For Link</label><input type="text" name="link_title[]" class="form-control" placeholder="Enter title for link" required></div></div><div class="col-md-4"><div class="form-group"><label for="">Link Name</label><input type="text" name="link_name[]" class="form-control" placeholder="Enter link name" required></div></div><div class="col-md-4"><div class="form-group"><label for="">Link (URL)</label><span class="pull-right" id="importantLink_'+increaseLength+'" style="font-size: 20px; height: 20px; font-weight: bolder; color: rgb(235, 8, 8); cursor: pointer; ">×</span><input type="text" name="link[]" class="form-control" placeholder="Enter url" required></div></div></div>');
        });

        $(document).on('click', "[id^=importantLink_]", function(){
            var id = $(this).attr('id');
            if(id != 'importantLink_1') {
                $('div.'+id).remove();
            }
        });
       
    });
    
</script>
    
@endsection

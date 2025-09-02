@extends('office_admin.master')
@section('body-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Digest Content
                <small>Add Digest Content</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Digest Content</a></li>
                <li class="active">Add Digest Content</li>
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

                                <form action="{{ route('office-digest-content-add') }}" role="form" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <input type="hidden" name="add_conent_key" value="set_content_key">
                                        <div class="form-group">
                                            <label for="">Title<span>*</span></label>
                                            <input type="text" name="title" class="form-control" placeholder="Enter content title" required>
                                            <small class="text-danger">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Feature Pics</label>
                                                    <input type="file" name="img" id="imageInput" class="form-control">
                                                </div>
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <img id="preview" height="100">
                                                </div>
                                            </div>
                                            @php
                                                $tags = \App\Models\Tag::all();
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Tag<span>*</span></label>
                                                    <select name="tag" id="tagItems" class="form-control" required>
                                                        <option value="" selected disabled>Choose a tag</option>
                                                        @foreach ($tags as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <small class="text-danger">
                                                    @error('tag')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                                <div class="addSubTag"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Content<span>*</span></label>
                                            <textarea class="digestConent" name="content" required></textarea>
                                        </div>
                                        <small class="text-danger">
                                            @error('content')
                                                {{ $message }}
                                            @enderror
                                        </small>
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
       $('#tagItems').on('change', function() {
          var value = $(this).val();
          $.ajax({
            url: '/office/digest/digest/content/add',
            type: 'POST',
            data: {
                'tag_return_id': 'tag_return_id',
                'tag_id': value,
            },
            success: function(response) {
                if(response.count != 0) {
                   var subtag = '<div class="form-group"><label for="">Sub Tag</label><select name="sub_tag" class="form-control">';
                    var item;
                    for (let i = 0; i < response.count; i++) {
                        let tg = response.sub_tag[i];
                       item +='<option value="'+tg.id+'">'+tg.name+'</option>';
                    }
                    subtag += item;
                    subtag +='<option value="" selected disabled>Choose a sub tag</option>';
                    subtag +='</select></div>';
                    $('.addSubTag').html(subtag);
                } else {
                    $('.addSubTag').html(
                      '<p style="text-align: center;">No sub tag found..!</p>'
                    );
                }
            }
        });
       });

       $('.digestConent').summernote({
                height: 500,
                minHeight: null,
                maxHeight: null,
                focus: false
        });
    });
</script>

<script>
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
    
@endsection

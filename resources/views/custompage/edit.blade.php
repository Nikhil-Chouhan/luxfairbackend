@extends('layouts.main') 
@section('title', 'Edit Custom Page')
@section('content')

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('plugins/dropzone/dist/dropzone.css')}}">
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-headphones bg-blue"></i>
                    <div class="d-inline">
                        <h5>Edit Custom Page</h5> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Edit Custom Page</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <!-- show redirect eeror  -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="forms-sample" method="POST" action="{{route('update-custompage')}}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$page->id}}">
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="title" >Title<span class="text-red">*</span></label>
                                    <input id="title"  value="{{ !empty($page->title)?$page->title: old('title') }}" type="text" class="form-control" name="title"   placeholder="Enter Page Name" required="">
                                    <div class="help-block with-errors"></div>


                                </div>
                            </div> 
                            <div class="col-sm-6">
                                @php
                                    
                                    $keywords = implode(',',unserialize($page->keywords)); 

                                @endphp
                                <div class="form-group">
                                    <label for="keywords" >Keywords<span class="text-red">*</span></label>
                                    <input id="keywords"  value="{{!empty($keywords)?$keywords: old('keywords') }}" type="text" class="form-control" name="keywords"   placeholder="Enter Keywords with ," required="">
                                    <div class="help-block with-errors"></div> 
                                </div>
                            </div> 
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="slug" >Slug<span class="text-red">*</span></label>
                                    <input id="slug"  value="{{ !empty($page->slug)?$page->slug:old('slug') }}" type="text" class="form-control" name="slug"   placeholder="" required="">
                                    <div class="help-block with-errors"></div> 
                                </div>
                            </div> 
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Active</label>
                                    <select class="form-control select2 " name="is_active"  id="is_active"  >
                                        <option   value="1" >Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label class="d-block">Banner Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*" >
                                </div>
                                <!-- show banner img  -->
                                @if(isset($page->image))
                                    <img src="{{asset('uploads/custompages/'.$page->image)}}" width="500px" height="200px" />
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control h-205" name="description" rows="5"  >{{ !empty($page->description)?$page->description:old('description') }}
                                    </textarea>

                                </div>
                            </div>
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label>Body</label>
                                    <textarea class="form-control html-editor  " name="body"   value="{{ old('body') }}"></textarea> 
                                </div>
                            </div>
                             
                        </div> 
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  

<script>
    var CSRF_TOKEN = '<?php echo csrf_token(); ?>';
    $(document).ready(function() {
   
        
        $('.html-editor').summernote( "code", '{!! $page->body !!}');
        var is_active = "{{ $page->is_active }}";
        if(is_active != ''){ 
            $('#is_active').val(is_active);
            $('#is_active').trigger('change'); 
        }
        $('#slug').focus(function() {


            
            // ajx callt cehck 
            var title = $('#title').val();
            $.ajax({
                type: "POST",
                url: 'generate-slug',
                data: {
                    _token: CSRF_TOKEN,
                    title: title
                },
                success: function (response) {
                    $('#slug').val(response.slug); 
                }
            });
        }); 
    });
</script>
@endsection
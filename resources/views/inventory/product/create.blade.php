@extends('layouts.main') 
@section('title', 'Add Product')
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
                        <h5>Add Product</h5>
                        <span>Add new product</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('admin/dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Add Product</a>
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

                    <form class="forms-sample" method="POST" action="{{route('store-products')}}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label for="name" >Name<span class="text-red">*</span></label>
                                    <input id="name"  value="{{ old('name') }}" type="text" class="form-control" name="name"   placeholder="Enter product Name" required="">
                                    <div class="help-block with-errors"></div>


                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Parent Category</label>
                                    <select class="form-control select2 " name="category_id" id="category_id" value="{{ old('category_id') }}">
                                        <option selected="selected" value="" data-select2-id="1">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Sub Category</label>
                                    <select class="form-control select2 " name="subcategory_id">
                                        <option selected="selected" value="" data-select2-id="2">Select SubCategory</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Product Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*" >
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Price</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Manufacturer</label>
                                    <select class="form-control select2 " name="manufacturer_id" id="manufacturer_id">
                                        <option selected="selected" value="" data-select2-id="3">Select Manufacturer</option>
                                        @foreach($manufacturers as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Active</label>
                                    <select class="form-control select2 " name="is_active" value="{{ old('is_active') }}">
                                        <option selected="selected" value="1" >Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">

<div class="form-group">
    <label class="d-block">Product of the Week</label>
    <select class="form-control select2 " name="is_featured" value="{{ old('is_featured') }}">
        <option selected="selected"  value="0">No</option>
        <option value="1" >Yes</option>
    </select>
</div>
</div>


                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Indoor/Outdoor</label>
                                    <select class="form-control select2 " name="indoor_outdoor" value="{{ old('indoor_outdoor') }}">
                                        <option selected="selected" value="indoor" >Indoor</option>
                                        <option value="outdoor">Outdoor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Code</label>
                                    <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}">
                                </div>
                            </div>

                            <!-- <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Sector</label>
                                    <input type="text" name="sector" id="sector" class="form-control" value="{{ old('sector') }}">
                                </div>
                            </div> -->

                            <div class="col-sm-6">
<div class="form-group">
    <label class="d-block">Sector</label>
    <select class="form-control select2" multiple name="sector_id[]" id="sector_id">
        <option value="" data-select2-id="4">Select Sector</option>
        @foreach($sector as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
</div>
</div>


                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Design</label>
                                    <input type="text" name="design" id="design" class="form-control" value="{{ old('design') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Connection</label>
                                    <input type="text" name="connection" id="connection" class="form-control" value="{{ old('connection') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Installation</label>
                                    <input type="text" name="installation" id="installation" class="form-control" value="{{ old('installation') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control h-205" name="short_description" rows="10" value="{{ old('short_description') }}"></textarea>

                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea class="form-control html-editor h-205" name="long_description" rows="10" value="{{ old('long_description') }}"></textarea>

                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group"><label>Gallery Images</label>
                                    
                                    <div class="dropzone">
                                        
                                        <div class="dropzone-previews"></div>
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </div>
                                    <div id="dropzone_uploaded">
                                        
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        @foreach($product_arr  as $key => $value)
                            <h5 class="bg-default">
                                {{ ucfirst($key) }}
                            </h5>
                            <div class="row">
                                @foreach($value  as $key => $item)
                         
                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label class="d-block">{{ucfirst($item['name'])}}</label>
                                        <input type="{{$item['type']}}" class="form-control" name="attribute[{{$item['id']}}_{{$item['name']}}]" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                           
                        @endforeach
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JS -->
<script src="{{asset('plugins/dropzone/dist/dropzone-min.js')}}" type="text/javascript"></script>

<script>

    Dropzone.autoDiscover = false;
    var CSRF_TOKEN='{{ csrf_token() }}';
    $(document).ready(function(){

        // alert($('.dropzone').length);
        if ($('.dropzone').length) {
            var myDropzone = new Dropzone(".dropzone",{ 
                    maxFilesize: 2, // 2 mb
                    acceptedFiles: ".jpeg,.jpg,.png",
                    url: "/products/gallerytempimgstore",
                    addRemoveLinks: true
            });
            myDropzone.on("sending", function(file, xhr, formData) {
                    formData.append("_token", CSRF_TOKEN);
            }); 
            myDropzone.on("success", function(file, response) {
                    if(response.success){ // Error
                        file.uploaded_name = response.filename; 
                        $('#dropzone_uploaded').append('<input type="hidden" name="gallery_images[]" value="'+response.filename+'">');
                    }
            });
            myDropzone.on("removedfile", function(file) {
                    var name = file.uploaded_name;
                    $.ajax({
                        type: 'POST',
                        url: '/products/gallerytempimgdelete',
                        data: {filename: name,_token: CSRF_TOKEN},
                        success: function (data){
                            $('#dropzone_uploaded').find('input[value="'+name+'"]').remove();
                        }
                    });
            });
        }
        

    });
    $('#category_id').on('change', function() {
        var category_id = $(this).val();
        $.ajax({
            url: '/admin/get_subcategories/' + category_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('select[name="subcategory_id"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_title + '</option>');
                });
            },
        });
    });
</script>

@endsection
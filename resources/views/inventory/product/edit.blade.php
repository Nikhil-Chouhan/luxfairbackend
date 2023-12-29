@extends('layouts.main') 
@section('title', 'Edit Product')
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
                        <h5>Edit Product</h5> 
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
                            <a href="#">Edit Product</a>
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

                    <form class="forms-sample" method="POST" action="{{route('update-products')}}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="product_id" value="{{$product->id}}" >
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="name" >Name   <span class="text-red">*</span></label>
                                    <input id="name" value="{{ !empty(old('name'))?old('name'):$product->name }}" type="text" class="form-control" name="name"   placeholder="Enter product Name" required="">
                                    <div class="help-block with-errors"></div>


                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="slug" >Slug   <span class="text-red">*</span></label>
                                    <input id="slug" value="{{ !empty(old('slug'))?old('slug'):$product->slug }}" type="text" class="form-control" name="slug"   placeholder="Enter product slug" required="">
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
                                        <option selected="selected" value="" data-select2-id="2">Select Category</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Product Image</label>
                                    @if(!empty($product->image))
                                        <img src="{{ asset($product->image) }}" style="width: 200px; height: 200px;">
                                    @endif
                                    <input type="file" class="form-control" name="image" accept="image/*" >
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Price</label>
                                    <input type="number" class="form-control" name="price" value="{{ !empty(old('price'))?old('price'):$product->price }}">
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
                                    <label class="d-block">Indoor/Outdoor</label>
                                    <select class="form-control select2 " name="indoor_outdoor"  >
                                        <option   value="indoor" @if($product->indoor_outdoor == 'indoor') selected @endif>Indoor</option>
                                        <option value="outdoor" @if($product->indoor_outdoor == 'outdoor') selected @endif>Outdoor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Code</label>
                                    <input type="text" name="code" id="code" class="form-control" value="@if(!empty(old('code'))){{ old('code') }}@else{{ $product->code }}@endif">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Sector</label>
                                    <input type="text" name="sector" id="sector" class="form-control" value="@if(!empty(old('sector'))){{ old('sector') }}@else{{ $product->sector }}@endif">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Design</label>
                                    <input type="text" name="design" id="design" class="form-control" value="@if(!empty(old('design'))){{ old('design') }}@else{{ $product->design }}@endif">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Connection</label>
                                    <input type="text" name="connection" id="connection" class="form-control" value=" @if(!empty(old('connection'))){{ old('connection') }}@else{{ $product->connection }}@endif">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="d-block">Installation</label>
                                    <input type="text" name="installation" id="installation" class="form-control" value="@if(!empty(old('installation'))){{ old('installation') }}@else{{ $product->installation }}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control h-205" name="short_description" rows="10" > {!! !empty(old('short_description'))?old('short_description'):$product->short_description !!}</textarea>

                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea class="form-control html-editor h-205" name="long_description" rows="10"  ></textarea>

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
                                        @php

                                            $prod_val_key =NULL;

                                            $prod_val_key = array_search($item['id'], array_column($product_metas, 'product_attribute_id'));  
                                            if(is_numeric($prod_val_key)){
                                               $value= $product_metas[$prod_val_key]['value'];
                                            }else{
                                                $value= '';
                                            } 

                                        @endphp
                                        <input type="{{$item['type']}}" class="form-control" name="attribute[{{$item['id']}}_{{$item['name']}}]" value="{{ $value}}" >
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
    // summernote set value
    $(document).ready(function() {
        $('.html-editor').summernote( "code", "{!! $product->long_description !!}");
    }); 



    // select option set as selected
    $(document).ready(function(){
        var category_id = "{{ !empty(old('category_id'))?old('category_id'):$product->category_id }}";
        var manufacturer_id = "{{ !empty(old('manufacturer_id'))?old('manufacturer_id'):$product->manufacturer_id }}";
        var subcategory_id = "{{ !empty(old('subcategory_id'))?old('subcategory_id'):$product->subcategory_id }}";
        var is_active = "{{ !empty(old('is_active'))?old('is_active'):$product->is_active }}";
        if(category_id != ''){
            $('#category_id').val(category_id);
            $('#category_id').trigger('change');
        }
        if(manufacturer_id != ''){
            $('#manufacturer_id').val(manufacturer_id);
        }
        if(subcategory_id != ''){
            $('#subcategory_id').val(subcategory_id);
        }
        if(is_active != ''){
            $('#is_active').val(is_active);
        }
    });
    

    Dropzone.autoDiscover = false;
    var CSRF_TOKEN='{{ csrf_token() }}';
    $(document).ready(function(){ 
        // alert($('.dropzone').length);
        if ($('.dropzone').length) {
            var myDropzone = new Dropzone(".dropzone",{ 
                    maxFilesize: 2, // 2 mb
                    acceptedFiles: ".jpeg,.jpg,.png",
                    url: "/admin/products/gallerytempimgstore",
                    addRemoveLinks: true
            });
            myDropzone.on("sending", function(file, xhr, formData) {
                    formData.append("_token", CSRF_TOKEN);
            }); 
            myDropzone.on("success", function(file, response) {
                    if(response.success){ // Error
                        file.uploaded_name = response.filename; 
                        file.uploaded_name =false; 
                        $('#dropzone_uploaded').append('<input type="hidden" name="gallery_images[]" value="'+response.filename+'">');
                    }
            });
            myDropzone.on("removedfile", function(file) {
                    var name = file.uploaded_name;
                    var is_old = file.is_old;
                    var product_id ={{ $product->id }};
                    $.ajax({
                        type: 'POST',
                        url: '/admin/products/gallerytempimgdelete',
                        data: {filename: name,is_old: is_old,product_id: product_id,_token: CSRF_TOKEN},
                        success: function (data){
                            $('#dropzone_uploaded').find('input[value="'+name+'"]').remove();
                            window.location.reload();
                        }
                    });
            });
            var product_gallery =@json($product_gallery); ;
            product_gallery.forEach(element => {
                // remove extenstion 
                var filename = element.image.split('.').slice(0, -1).join('.');
               
                
                var mockFile = { name:filename,uploaded_name:element.image,is_old:true};
                
                let callback = null; // Optional callback when it's done
                let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
                let resizeThumbnail = false; // Tells Dropzone whether it should resize the image first
                myDropzone.displayExistingFile(mockFile, '/'+ element.image, callback, crossOrigin, resizeThumbnail); 
                $('#dropzone_uploaded').append('<input type="hidden" name="gallery_images[]" value="'+element.image+'">');
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
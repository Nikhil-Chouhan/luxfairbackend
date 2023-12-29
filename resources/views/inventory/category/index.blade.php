@extends('layouts.main') 
@section('title', 'Categories')
@section('content')
    <!-- push external head elements to head --> 
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Categories')}}</h5>
                            <span>Add, remove or edit product categories</span>
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
                                <a href="#">{{ __('Categories')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
               
                <button class="btn btn-outline-primary btn-rounded-20" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd">
                    Add Category
                </button>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Categories')}}</h3></div>
                        <div class="card-body">
                            <table id="category_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Title')}}</th>
                                        <th>{{ __('Slug')}}</th>
                                        <th>{{ __('Description')}}</th>
                                        <th>{{ __('Image')}}</th>
                                        <th>{{ __('Is Active')}}</th>
                                        <th>{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- category add modal-->
    <div class="modal fade edit-layout-modal pr-0 " id="categoryAdd" tabindex="-1" role="dialog" aria-labelledby="categoryAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form  method="POST" action="{{ route('store-category') }}" enctype="multipart/form-data" >
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Category')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">Category Image</label>
                            <input type="file"  accept="image/*"  name="category_img" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Title</label>
                            <input type="text" name="category_title" class="form-control" placeholder="Enter Category Title">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Slug</label>
                            <input type="text" name="category_slug" class="form-control" placeholder="Enter Category Slug">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Description</label>
                            <textarea class="form-control "  name="category_description" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Active</label>
                            <select class="form-control select2 " name="is_active">
                                <option selected="selected" value="1" >Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label class="d-block">Parent Category</label>
                            <select class="form-control select2 ">
                                <option selected="selected" value="" data-select2-id="3">Select Category</option>
                                <option value="1">Electronics</option>
                                <option value="3">Smart Home</option>
                                <option value="4">Arts &amp; Crafts</option>
                                <option value="5">Fashion</option>
                                <option value="6">Baby</option>
                                <option value="7">Health &amp; Care</option>
                                <option value="8">Others</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Save" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- category edit modal -->
    <div class="modal fade edit-layout-modal pr-0 " id="categoryView" tabindex="-1" role="dialog" aria-labelledby="categoryViewLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form action="{{ route('update-category')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryViewLabel">{{ __('Edit Category')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <img src="" alt="" id="edit_modal_img" width=250 height=250>
                        <div class="form-group">
                            <label class="d-block">Category Image</label>
                            <input type="file" accept="image/*"  name="category_img" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Title</label>
                            <input type="text" name="category_title" class="form-control" placeholder="Enter Category Title">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Slug</label>
                            <input type="text" name="category_slug" class="form-control" placeholder="Enter Category Slug">
                        </div>
                        
                        <div class="form-group">
                            <label class="d-block">Description</label>
                            <textarea class="form-control "  name="category_description" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Active</label>
                            <select class="form-control select2 " name="is_active">
                                <option value="1" >Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label class="d-block">Parent Category</label>
                            <select class="form-control select2 ">
                                <option selected="selected" value="" data-select2-id="3">Select Category</option>
                                <option value="1">Electronics</option>
                                <option value="3">Smart Home</option>
                                <option value="4">Arts &amp; Crafts</option>
                                <option value="5">Fashion</option>
                                <option value="6">Baby</option>
                                <option value="7">Health &amp; Care</option>
                                <option value="8">Others</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Update" value="Update">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Execute something when the modal window is shown.
        $('#categoryView').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var title = button.data('title'); // Extract info from data-* attributes
        var slug = button.data('slug'); // Extract info from data-* attributes
        var img = button.data('img'); // Extract info from data-* attributes
        var id = button.data('id'); // Extract info from data-* attributes
        var is_active = button.data('is_active'); // Extract info from data-* attributes
        var description = button.data('description'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-title').text('Edit Category ' + title);
        modal.find('.modal-body input[name="category_title"]').val(title);
        modal.find('.modal-body input[name="category_slug"]').val(slug);
        modal.find('.modal-body textarea[name="category_description"]').val(description);
        // modal.find('.modal-body input[name="category_img"]').val(img);
        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body select[name="is_active"]').val(is_active).trigger('change');
        modal.find('.modal-body img#edit_modal_img').attr('src', img);
     
        });
    </script>

    <!--server side  table script-->
    <script src="{{ asset('js/custom/categories.js') }}"></script>
@endsection
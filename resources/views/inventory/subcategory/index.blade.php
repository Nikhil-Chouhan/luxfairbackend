@extends('layouts.main') 
@section('title', 'SubCategories')
@section('content')
    <!-- push external head elements to head --> 
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('SubCategories')}}</h5>
                            <span>Add, remove or edit product subcategories</span>
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
                                <a href="#">{{ __('SubCategories')}}</a>
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
                <button class="btn btn-outline-primary btn-rounded-20" href="#subcategoryAdd" data-toggle="modal" data-target="#subcategoryAdd">
                    Add SubCategory
                </button>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Subcategories')}}</h3></div>
                        <div class="card-body">
                            <table id="subcategory_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Title')}}</th>
                                        <th>{{ __('Slug')}}</th>
                                        <th>{{ __('Description')}}</th>
                                        <th>{{ __('Image')}}</th>
                                        <th>{{ __('Parent Category')}}</th>
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
    <!-- subcategory add modal-->
    <div class="modal fade edit-layout-modal pr-0 " id="subcategoryAdd" tabindex="-1" role="dialog" aria-labelledby="subcategoryAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form  method="POST" action="{{ route('store-subcategory') }}" enctype="multipart/form-data" >
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subcategoryAddLabel">{{ __('Add SubCategory')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">SubCategory Image</label>
                            <input type="file" name="subcategory_img" accept="image/*"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="d-block">SubCategory Title</label>
                            <input type="text" name="subcategory_title" class="form-control" placeholder="Enter SubCategory Title">
                        </div>
                        <div class="form-group">
                            <label class="d-block">SubCategory Slug</label>
                            <input type="text" name="subcategory_slug" class="form-control" placeholder="Enter SubCategory Slug">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Description</label>
                            <textarea class="form-control "  name="subcategory_description" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Active</label>
                            <select class="form-control select2 " name="is_active">
                                <option selected="selected" value="1" >Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Parent Category</label>
                            <select class="form-control select2 " name="category_id">
                                <option selected="selected" value="" data-select2-id="4">Select Category</option>
                                @foreach($parentcategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Save" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- subcategory edit modal -->
    <div class="modal fade edit-layout-modal pr-0 " id="subcategoryView" tabindex="-1" role="dialog" aria-labelledby="subcategoryViewLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form action="{{ route('update-subcategory')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subcategoryViewLabel">{{ __('Edit Category')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <img src="" alt="" id="edit_modal_img" width=250 height=250>
                        <div class="form-group">
                            <label class="d-block">Category Image</label>
                            <input type="file" name="subcategory_img" accept="image/*" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Title</label>
                            <input type="text" name="subcategory_title" class="form-control" placeholder="Enter Category Title">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Slug</label>
                            <input type="text" name="subcategory_slug" class="form-control" placeholder="Enter Category Slug">
                        </div>
                        
                        <div class="form-group">
                            <label class="d-block">Description</label>
                            <textarea class="form-control "  name="subcategory_description" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Active</label>
                            <select class="form-control select2 " name="is_active">
                                <option value="1" >Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="d-block">Parent Category</label>
                            <select class="form-control select2 "  name="category_id">
                                <option selected="selected" value="" data-select2-id="4">Select Category</option>
                                @foreach($parentcategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                @endforeach
                            </select>
                        </div>
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
        $('#subcategoryView').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var title = button.data('title'); // Extract info from data-* attributes
        var slug = button.data('slug'); // Extract info from data-* attributes
        var img = button.data('img'); // Extract info from data-* attributes
        var id = button.data('id'); // Extract info from data-* attributes
        var is_active = button.data('is_active'); // Extract info from data-* attributes
        var category_id = button.data('category_id'); // Extract info from data-* attributes
        var description = button.data('description'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-title').text('Edit Category ' + title);
        modal.find('.modal-body input[name="subcategory_title"]').val(title);
        modal.find('.modal-body input[name="subcategory_slug"]').val(slug);
        modal.find('.modal-body textarea[name="subcategory_description"]').val(description);
        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body select[name="is_active"]').val(is_active).trigger('change');
        modal.find('.modal-body select[name="category_id"]').val(category_id).trigger('change');
        modal.find('.modal-body img#edit_modal_img').attr('src', img);
     
        });
    </script>
    
    <!--server side  table script-->
    <script src="{{ asset('js/custom/subcategories.js') }}"></script>
@endsection
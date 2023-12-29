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
                <div class="mb-2 clearfix">
                    <a class="btn pt-0 pl-0 d-md-none d-lg-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
                        {{ __('Display Options')}}
                        <i class="ik ik-chevron-down align-middle"></i>
                    </a>
                    <div class="collapse d-md-block display-options" id="displayOptions">
                        <span class="mr-3 d-inline-block float-md-left dispaly-option-buttons">
                            <a href="#" class="mr-1 view-thumb ">
                                <i class="ik ik-list view-icon"></i>
                            </a>
                            <a href="#" class="mr-1 view-grid active">
                                <i class="ik ik-grid view-icon"></i>
                            </a>
                        </span>
                        <div class="d-block d-md-inline-block">
                            <div class="btn-group float-md-left mr-1 mb-1">
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('
                                    Order By')}} 
                                    <i class="ik ik-chevron-down mr-0 align-middle"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">{{ __('DESC')}}</a>
                                    <a class="dropdown-item" href="#">{{ __('ASC')}}</a>
                                </div>
                            </div>
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <form action="">
                                    <input type="text" class="form-control" placeholder="Search.." required>
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    <button type="button" id="adv_wrap_toggler" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="adv-search-wrap dropdown-menu dropdown-menu-right" aria-labelledby="adv_wrap_toggler">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Category Title">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Category Code">
                                        </div>
                                        <button class="btn btn-theme">{{ __('Search')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="float-md-right">
                            <span class="text-muted text-small mr-2">{{ __('Displaying 1-10 of 210 items')}} </span>
                            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                20
                                <i class="ik ik-chevron-down mr-0 align-middle"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">10</a>
                                <a class="dropdown-item" href="#">20</a>
                                <a class="dropdown-item" href="#">30</a>
                                <a class="dropdown-item" href="#">50</a>
                                <a class="dropdown-item" href="#">100</a>
                            </div>
                            <button class="btn btn-outline-primary btn-rounded-20" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd">
                                Add Category
                            </button>
                        </div>
                    </div>
                </div>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    
                    @foreach($categories as $category)
                        
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-4 list-item list-item-grid">
                            <div class="card d-flex flex-row mb-3">
                                <a class="d-flex card-img">
                                    <img src="{{ $category->category_img }}" alt="Donec sit amet est at sem iaculis aliquam." class="list-thumbnail responsive border-0">
                                    
                                    
                                    <span class="badge badge-pill {{ $category->is_active == 1 ? 'badge-success' : 'badge-danger'  }} position-absolute badge-top-left">
                                        {{ $category->is_active == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero card-content">
                                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center mb-0">
                                        <a class="mb-1 list-item-heading  truncate w-40 w-xs-100" >
                                            <b>{{ $category->category_title }} 
                                            </b> 
                                            <span class="text-muted">
                                            </span>
                                            
                                        </a>
                                        <p class="mb-1 text-muted text-small date w-15 w-xs-100">
                                        Slug: {{ $category->category_slug }}
                                        @if ($category->category_description)
                                            <br>
                                            {{
                                                $category->category_description
                                            }}
                                        @endif
                                        </p>
                                    </div>
                                    <div class="list-actions">
                                        <a href="#categoryView" data-toggle="modal" data-target="#categoryView"
                                        data-title = "{{ $category->category_title }}"
                                        data-slug = "{{ $category->category_slug }}"
                                        data-img = "{{ $category->category_img }}"
                                        data-is_active = "{{ $category->is_active }}"
                                        data-id = "{{ $category->id }}"
                                        data-description = "{{ $category->category_description }}"
                                        
                                        ><i class="ik ik-edit-2"></i></a>
                                        <a href="/category/delete/{{$category->id }}" class="list-delete"><i class="ik ik-trash-2"></i></a>
                                    </div>
                                    <!-- <div class="custom-control custom-checkbox pl-1 align-self-center">
                                        <label class="custom-control custom-checkbox mb-0">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div> -->
                                    
                                </div>
                            </div>
                        </div>
                    
                    @endforeach
                    
                </div>
                
            </div>
        </div>
    </div>
    <!-- category add modal-->
    <div class="modal fade edit-layout-modal pr-0 " id="categoryAdd" tabindex="-1" role="dialog" aria-labelledby="categoryAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form  method="POST" action="{{ route('create-category') }}" enctype="multipart/form-data" >
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Category')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">Category Image</label>
                            <input type="file" name="category_img" class="form-control">
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
                            <input type="file" name="category_img" class="form-control">
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
@endsection
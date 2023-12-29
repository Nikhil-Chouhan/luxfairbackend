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
                            <button class="btn btn-outline-primary btn-rounded-20" href="#subcategoryAdd" data-toggle="modal" data-target="#subcategoryAdd">
                                Add SubCategory
                            </button>
                        </div>
                    </div>
                </div>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    
                    @foreach($subcategories as $subcategory)
                        
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-4 list-item list-item-grid">
                            <div class="card d-flex flex-row mb-3">
                                <a class="d-flex card-img">
                                    <img src="{{ $subcategory->subcategory_img }}" alt="Donec sit amet est at sem iaculis aliquam." class="list-thumbnail responsive border-0">
                                    
                                    
                                    <span class="badge badge-pill {{ $subcategory->is_active == 1 ? 'badge-success' : 'badge-danger'  }} position-absolute badge-top-left">
                                        {{ $subcategory->is_active == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero card-content">
                                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center mb-0">
                                        <a class="mb-1 list-item-heading  truncate w-40 w-xs-100" >
                                            <b>{{ $subcategory->subcategory_title }} 
                                            </b> 
                                            <span class="text-muted">
                                            </span>
                                            
                                        </a>
                                        <p class="mb-1 text-muted text-small date w-15 w-xs-100">
                                        Slug: {{ $subcategory->subcategory_slug }}
                                        @if ($subcategory->subcategory_description)
                                            <br>
                                            {{
                                                $subcategory->subcategory_description
                                            }}
                                        @endif
                                        </p>
                                    </div>
                                    <div class="list-actions">
                                        <a href="#subcategoryView" data-toggle="modal" data-target="#subcategoryView"
                                        data-title = "{{ $subcategory->subcategory_title }}"
                                        data-slug = "{{ $subcategory->subcategory_slug }}"
                                        data-img = "{{ $subcategory->subcategory_img }}"
                                        data-is_active = "{{ $subcategory->is_active }}"
                                        data-id = "{{ $subcategory->id }}"
                                        data-description = "{{ $subcategory->subcategory_description }}"
                                        data-category_id = "{{ $subcategory->category_id }}"
                                        
                                        ><i class="ik ik-edit-2"></i></a>
                                        <a href="/subcategory/delete/{{$subcategory->id }}" class="list-delete"><i class="ik ik-trash-2"></i></a>
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
    <!-- subcategory add modal-->
    <div class="modal fade edit-layout-modal pr-0 " id="subcategoryAdd" tabindex="-1" role="dialog" aria-labelledby="subcategoryAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form  method="POST" action="{{ route('create-subcategory') }}" enctype="multipart/form-data" >
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subcategoryAddLabel">{{ __('Add SubCategory')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">SubCategory Image</label>
                            <input type="file" name="subcategory_img" class="form-control">
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
                            <input type="file" name="subcategory_img" class="form-control">
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
@endsection
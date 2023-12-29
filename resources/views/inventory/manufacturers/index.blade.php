@extends('layouts.main') 
@section('title', 'Manufacturers')
@section('content')
    <!-- push external head elements to head -->     

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Manufacturers')}}</h5>
                            <span>Add, remove or edit manufacturers</span>
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
                                <a href="#">{{ __('Manufacturers')}}</a>
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
               
                <button class="btn btn-outline-primary btn-rounded-20" href="#manufacturersAdd" data-toggle="modal" data-target="#manufacturersAdd">
                    Add Manufacturer
                </button>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Manufacturers')}}</h3></div>
                        <div class="card-body">
                            <table id="manufacturers_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name')}}</th>
                                        <th>{{ __('Description')}}</th>
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
    <div class="modal fade edit-layout-modal pr-0 " id="manufacturersAdd" tabindex="-1" role="dialog" aria-labelledby="manufacturersAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form  method="POST" action="{{ route('store-manufacturers') }}" enctype="multipart/form-data" >
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manufacturersAddLabel">{{ __('Add Manufacturers')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Enter Type">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
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
    <div class="modal fade edit-layout-modal pr-0 " id="manufacturerView" tabindex="-1" role="dialog" aria-labelledby="manufacturerViewLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form action="{{ route('update-manufacturers')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manufacturerViewLabel">{{ __('Edit Manufacturer')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="d-block">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Enter Type">
                        </div>
                        <img src="" alt="" id="edit_modal_img" width=250 height=250>
                        <div class="form-group">
                            <label class="d-block">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Update" value="Update">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

   <!-- push external js -->
   @push('script')
    <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>

    <script>
        // Execute something when the modal window is shown.
        $('#manufacturerView').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var description = button.data('description'); // Extract info from data-* attributes
        var name = button.data('name'); // Extract info from data-* attributes
        var image = button.data('image'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-title').text('Edit Category ' + name);
        modal.find('.modal-body input[name="name"]').val(name);
        modal.find('.modal-body input[name="description"]').val(description);
        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body img#edit_modal_img').attr('src', '/'+image);
     
        });
    </script>

    <!--server side  table script-->
    <script src="{{ asset('js/custom/manufacturers.js') }}"></script>
    @endpush
@endsection
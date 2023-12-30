@extends('layouts.main') 
@section('title', 'Sector')
@section('content')
    <!-- push external head elements to head -->     

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Sector')}}</h5>
                            <span>Add, remove or edit Sector</span>
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
                                <a href="#">{{ __('Sector')}}</a>
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
               
                <button class="btn btn-outline-primary btn-rounded-20" href="#sectorAdd" data-toggle="modal" data-target="#sectorAdd">
                    Add Sector
                </button>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Sector')}}</h3></div>
                        <div class="card-body">
                            <table id="sector_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name')}}</th>
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
    <div class="modal fade edit-layout-modal pr-0 " id="sectorAdd" tabindex="-1" role="dialog" aria-labelledby="sectorAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form  method="POST" action="{{ route('store-sector') }}" enctype="multipart/form-data" >
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sectorAddLabel">{{ __('Add Sector')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
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
    <div class="modal fade edit-layout-modal pr-0 " id="sectorView" tabindex="-1" role="dialog" aria-labelledby="sectorViewLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form action="{{ route('update-sector')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sectorViewLabel">{{ __('Edit Sector')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="d-block">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
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
        $('#sectorView').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var name = button.data('name'); // Extract info from data-* attributes
        var image = button.data('image'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-title').text('Edit Category ' + name);
        modal.find('.modal-body input[name="name"]').val(name);
        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body img#edit_modal_img').attr('src', '/'+image);
     
        });
    </script>

    <!--server side  table script-->
    <script src="{{ asset('js/custom/sector.js') }}"></script>
    @endpush
@endsection
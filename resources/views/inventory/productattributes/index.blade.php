@extends('layouts.main') 
@section('title', 'Product Attributes')
@section('content')
    <!-- push external head elements to head -->     

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Product Attributes')}}</h5>
                            <span>Add, remove or edit product attributes</span>
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
                                <a href="#">{{ __('Product Attributes')}}</a>
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
               
                <button class="btn btn-outline-primary btn-rounded-20" href="#product_attributesAdd" data-toggle="modal" data-target="#product_attributesAdd">
                    Add Product Attribute
                </button>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Product Attributes')}}</h3></div>
                        <div class="card-body">
                            <table id="productattributes_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name')}}</th>
                                        <th>{{ __('Type')}}</th>
                                        <th>{{ __('Group')}}</th>
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
    <div class="modal fade edit-layout-modal pr-0 " id="product_attributesAdd" tabindex="-1" role="dialog" aria-labelledby="product_attributesAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <form  method="POST" action="{{ route('store-product_attributes') }}" enctype="multipart/form-data" >
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="product_attributesAddLabel">{{ __('Add Product Attributes')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Type</label>
                            <input list="types" name="type" id="type" class="form-control" placeholder="Enter Type" autocomplete='off'>
                            <datalist id="types"> 
                                <option value="date"> 
                                <option value="email"> 
                                <option value="month">
                                <option value="number"> 
                                <option value="tel">
                                <option value="text"> 
                                <option value="url">
                                <option value="week">
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Group</label>
                            <input type="text" name="group" class="form-control" placeholder="Enter Group">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Save" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    

   <!-- push external js -->
   @push('script')
    <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>

    <!--server side  table script-->
    <script src="{{ asset('js/custom/product_attributes.js') }}"></script>
    @endpush
@endsection
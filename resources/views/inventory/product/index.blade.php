@extends('layouts.main') 
@section('title', 'Products')
@section('content')
    <!-- push external head elements to head -->     

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Products')}}</h5>
                            <span>Add, remove or edit Products</span>
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
                                <a href="#">{{ __('Products')}}</a>
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
               
                <a class="btn btn-outline-primary btn-rounded-20" href="{{ route('create-products') }}" >
                    Add Product
                </a>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Products')}}</h3></div>
                        <div class="card-body">
                            <table id="product_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name')}}</th>
                                        <th>{{ __('Image')}}</th>
                                        <th>{{ __('Description')}}</th>
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

    

   <!-- push external js -->
   @push('script')
    <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>

    <!--server side  table script-->
    <script src="{{ asset('js/custom/products.js') }}"></script>
    @endpush
@endsection
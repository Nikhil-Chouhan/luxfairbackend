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
               
            <div id="bulk_upload" class="pb-5">
                        <h4>Bulk Upload</h4>
                        <a href="{{ asset('bulk/products/products_import.xlsx')}}" class="btn btn-success">
                            Sample Import Format
                        </a>
                        <p>
                            <b>Instructions:</b>
                            <ul>
                                <li>Download Sample Import Format</li>
                                <li>Fill the sample import format with your data</li>
                                <li>Upload the filled sample import format</li> 
                                <li>Upload product images with names same as you wrote in the excel</li>
                            </ul>
                        </p>
                        <form action="{{route('import_products')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="file" name="file" id="" class="form-control" required accept=".xlsx,.xls">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Import Products
                                    </button> 
                                </div>
                            </div>
                        </form>
                        <form action="{{route('import_product_imgs')}}" method="post"  enctype="multipart/form-data" class="pt-4">
                            @csrf
                            <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="product_id" id="product" class="form-control form-select select2">
                                        <option value="" selected disabled>{{ __('Select Product')}}</option>
                                        @foreach($products as $c)
                                            <option value="{{$c->id}}">
                                             {{$c->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="file" name="images[]" id="" class="form-control" required multiple accept="image/*,video/*">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Upload Product Images
                                    </button> 
                                </div>
                            </div>
                        </form>
                    </div>

             
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    <div class="card p-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class=""><h3>{{ __('Products')}}</h3></div>
                            <div class=""><a class="btn btn-outline-primary btn-rounded-20" href="{{ route('create-products') }}" >
                            Add Product </a></div></div>
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
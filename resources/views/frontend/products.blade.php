

@extends('frontend.include.main')
@section('title', 'Products')
 
@section('content')
<style>
    .accordion .card:last-of-type{
        border-bottom: 1px solid #ddd;
    }
</style>

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><a href="index.html"><img src="{{asset('frontend/images/Home11.png')}}" class="see_11"></a> / <a
                            href="{{route('frontend.products')}}">Products</a></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn  " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Manufacturers <i class="fa fa-angle-down"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body"> 
                                    @php

                                        $all_manufacturers = App\Models\Manufacturer::all();
                                        $manufacturer_ids = [];
                                        if(request()->has('manufacturer')){
                                            $manufacturer_ids = explode(',', request()->manufacturer);
                                        }
                                    @endphp



                                    @foreach($all_manufacturers as $manufacturer)
                                        <input type="checkbox" id="manufacturer_{{$manufacturer->id}}" name="manufacturer" class="manufacturer_filter" value="{{$manufacturer->id}}" @if(in_array($manufacturer->id, $manufacturer_ids)) checked @endif>
                                        <label for="manufacturer_{{$manufacturer->id}}">{{$manufacturer->name}}</label>
                                        <br>
                                    @endforeach
                                </div>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div>

                <div class="col-xl-8 col-lg-8 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <!--nothingstart-->
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-12 text-center text-sm-left">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="toolbar-sorter-right ">

                                            <select class="indoor indoor_outdoor_filter">
                                                <option value="indoor"  @if(request()->has('indoor_outdoor_filter') && request()->indoor_outdoor_filter == 'indoor') selected @endif>Indoor ({{$indoor_products_count}})</option>
                                                <option value="outdoor" @if(request()->has('indoor_outdoor_filter') && request()->indoor_outdoor_filter == 'outdoor') selected @endif>Outdoor ({{$outdoor_products_count}})</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="toolbar-sorter-right shor_ff">
                                            <span>Show products: </span>
                                            <select class="showproducts showproducts_filter">
                                                <option value="30" @if(request()->has('showproducts') && request()->showproducts == 30) selected @endif>30</option>
                                                <option value="60" @if(request()->has('showproducts') && request()->showproducts == 60) selected @endif>60</option>
                                                <option value="all" @if(request()->has('showproducts') && request()->showproducts == 'all') selected @endif>All</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="toolbar-sorter-right shor_ff">
                                            <span>Sort: </span>
                                            <select class="showproducts other_filter">
                                                <option value="popularity" @if(request()->has('other_filter') && request()->other_filter == 'popularity') selected @endif>Popularity</option>
                                                <option value="manu_a_z" @if(request()->has('other_filter') && request()->other_filter == 'manu_a_z') selected @endif>Manufacturer (A to Z)</option>
                                                <option value="manu_z_a" @if(request()->has('other_filter') && request()->other_filter == 'manu_z_a') selected @endif>Manufacturer (Z to A)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--nothingend-->

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @foreach($all_products as $product)

                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="products-single fix">
                                                    <a href="{{route('frontend.product_detail', $product->slug)}}">
                                                        <div class="box-img-hover"> 
                                                            <img src="{{asset($product->image)}}" class="img-fluid" alt="Image">
                                                            <!-- <div class="type_s">
                                                                <i class="far fa-heart"></i>
                                                            </div> -->
    
                                                        </div>
                                                        <div class="why-text">
                                                            <h4>
                                                                {{$product->name}}
                                                            </h4> 
                                                        </div>
                                                    </a>
                                                </div>
                                            </div> 
                                        @endforeach
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <!--<div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div>-->
                                                        <img src="{{asset('frontend/images/img-pro')}}-01.jpg" class="img-fluid" alt="Image">
                                                        <div class="type_s">
                                                            <i class="far fa-heart"></i>
                                                        </div>
                                                        <!--<div class="mask-icon">
															<ul>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
															</ul>
															<a class="cart" href="#">Add to Cart</a>
														</div>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>FIXTURE TYPE NAME</h4>
                                                    <!--<h5> <del>$ 60.00</del> $40.79</h5>-->
                                                    <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien,
                                                        imperdiet quis magna nec, iaculis ultrices ante. Integer vitae
                                                        suscipit nisi. Morbi dignissim risus sit amet orci porta, eget
                                                        aliquam purus
                                                        sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in
                                                        blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus,
                                                        quis euismod ex volutpat in. Vestibulum eleifend eros ac
                                                        lobortis aliquet.
                                                        Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin
                                                        quam. Praesent vulputate semper libero pulvinar consequat. Etiam
                                                        ut placerat lectus.</p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <!--<div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div>-->
                                                        <img src="{{asset('frontend/images/img-pro')}}-02.jpg" class="img-fluid" alt="Image">
                                                        <div class="type_s">
                                                            <i class="far fa-heart"></i>
                                                        </div>
                                                        <!--<div class="mask-icon">
															<ul>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
															</ul>
															<a class="cart" href="#">Add to Cart</a>
														</div>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>FIXTURE TYPE NAME</h4>
                                                    <!--<h5> <del>$ 60.00</del> $40.79</h5>-->
                                                    <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien,
                                                        imperdiet quis magna nec, iaculis ultrices ante. Integer vitae
                                                        suscipit nisi. Morbi dignissim risus sit amet orci porta, eget
                                                        aliquam purus
                                                        sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in
                                                        blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus,
                                                        quis euismod ex volutpat in. Vestibulum eleifend eros ac
                                                        lobortis aliquet.
                                                        Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin
                                                        quam. Praesent vulputate semper libero pulvinar consequat. Etiam
                                                        ut placerat lectus.</p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <!--<div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div>-->
                                                        <img src="{{asset('frontend/images/img-pro')}}-03.jpg" class="img-fluid" alt="Image">
                                                        <div class="type_s">
                                                            <i class="far fa-heart"></i>
                                                        </div>
                                                        <!--<div class="mask-icon">
															<ul>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
																<li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
															</ul>
															<a class="cart" href="#">Add to Cart</a>
														</div>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>Lorem ipsum dolor sit amet</h4>
                                                    <!--<h5> <del>$ 60.00</del> $40.79</h5>-->
                                                    <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien,
                                                        imperdiet quis magna nec, iaculis ultrices ante. Integer vitae
                                                        suscipit nisi. Morbi dignissim risus sit amet orci porta, eget
                                                        aliquam purus
                                                        sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in
                                                        blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus,
                                                        quis euismod ex volutpat in. Vestibulum eleifend eros ac
                                                        lobortis aliquet.
                                                        Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin
                                                        quam. Praesent vulputate semper libero pulvinar consequat. Etiam
                                                        ut placerat lectus.</p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
    @endsection
    @push('scripts') 
    <script> 
    // docuemnt .load 
    $(document).ready(function(){ 
        // manufacturer filter
        $('.manufacturer_filter').click(function(){
            var manufacturer = [];
            $('.manufacturer_filter:checked').each(function(){
                manufacturer.push($(this).val());
            });
            manufacturer = manufacturer.toString();  
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set('manufacturer', manufacturer)
            window.location.search = searchParams.toString()
        });
        // showproducts_filter filter
        $('.showproducts_filter').change(function(){
            $selected_value = $(this).val();
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set('showproducts', $selected_value)
            window.location.search = searchParams.toString()
        });
        // other_filter filter
        $('.other_filter').change(function(){
            $selected_value = $(this).val();
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set('other_filter', $selected_value)
            window.location.search = searchParams.toString()
        });
        // indoor_outdoor_filter filter
        $('.indoor_outdoor_filter').change(function(){
            $selected_value = $(this).val();
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set('indoor_outdoor_filter', $selected_value)
            window.location.search = searchParams.toString()
        });
    });
    </script>
    <!--tabend-->

    @endpush
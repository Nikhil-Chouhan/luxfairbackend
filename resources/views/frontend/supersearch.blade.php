@extends('frontend.include.main')
@section('title', 'Super Search')
@section('content')
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
                        href="{{route('frontend.supersearch')}}">Super Search</a></h2>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Super Search</h1>
                </div>
            </div>
        </div>

        <div class="row special-list" style="position: relative; height: 385px;">
        <div class="col-lg-3 col-md-6 special-grid fruits" >
                <div class="products-single1 fix">
                    <div class="box-img-hover">

                    @php

$all_sector = App\Models\Sector::all();
$sector_ids = [];
if(request()->has('sector')){
$sector_ids = explode(',', request()->sector);
}
@endphp

                        <select name="sector" id="cars">
                            <option value="">SECTOR</option>
@foreach($all_sector as $sector)
<option value="{{$sector->id}}" @if(in_array($sector->id, $sector_ids)) selected @endif > {{$sector->name}}</option>
@endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid fruits" >
                <div class="products-single1 fix">
                    <div class="box-img-hover">

                    @php
$all_manufacturers = App\Models\Manufacturer::all();
$manufacturer_ids = [];
if(request()->has('manufacturer')){
$manufacturer_ids = explode(',', request()->manufacturer);
}
@endphp
                        <select name="manufacturer" id="cars">
                            <option value="">MANUFACTURER</option>
@foreach($all_manufacturers as $manufacturer)
<option value="{{$manufacturer->id}}" @if(in_array($manufacturer->id, $manufacturer_ids)) selected @endif > {{$manufacturer->name}}</option>
@endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid fruits" >
                <div class="products-single1 fix">
                    <div class="box-img-hover">

                    @php

$all_category = App\Models\Category::all();
$category_ids = [];
if(request()->has('category')){
$category_ids = explode(',', request()->category);
}
@endphp
                        <select name="category" id="cars">
                            <option value="">CATEGORIES</option>
                            @foreach($all_category as $category)
<option value="{{$category->id}}" @if(in_array($category->id, $category_ids)) selected @endif > {{$category->category_title}}</option>
@endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid fruits" >
                <div class="products-single1 fix">
                    <div class="box-img-hover">
                        <select class="indoor indoor_outdoor_filter" name="indoor_outdoor_filter" id="cars">
                                            <option value="indoor" @if(request()->has('indoor_outdoor_filter') &&
                                                request()->indoor_outdoor_filter == 'indoor') selected @endif>Indoor
                                                ({{$indoor_products_count}})</option>
                                            <option value="outdoor" @if(request()->has('indoor_outdoor_filter') &&
                                                request()->indoor_outdoor_filter == 'outdoor') selected @endif>Outdoor
                                                ({{$outdoor_products_count}})</option>
                                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="openBtn" id="searchsuperbtn"> Search </button>
            </div>
        </div>
    </div>
</div>
<hr />

<!-- Start Shop Page  -->
@if($hasresult)

<div class="shop-box-inner">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-sm-10 col-xs-10 shop-content-center">
                <div class="right-product-box">
                    <!--nothingstart-->
                    <!-- <div class="product-item-filter row">
                        <div class="col-12 col-sm-12 text-center text-sm-left">
                            <div class="row">
                             
                                <div class="col-md-4">
                                    <div class="toolbar-sorter-right shor_ff">
                                        <span>Show products: </span>
                                        <select class="showproducts showproducts_filter">
                                            <option value="30" @if(request()->has('showproducts') &&
                                                request()->showproducts == 30) selected @endif>30</option>
                                            <option value="60" @if(request()->has('showproducts') &&
                                                request()->showproducts == 60) selected @endif>60</option>
                                            <option value="all" @if(request()->has('showproducts') &&
                                                request()->showproducts == 'all') selected @endif>All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="toolbar-sorter-right shor_ff">
                                        <span>Sort: </span>
                                        <select class="showproducts other_filter">
                                            <option value="popularity" @if(request()->has('other_filter') &&
                                                request()->other_filter == 'popularity') selected @endif>Popularity
                                            </option>
                                            <option value="manu_a_z" @if(request()->has('other_filter') &&
                                                request()->other_filter == 'manu_a_z') selected @endif>Manufacturer (A
                                                to Z)</option>
                                            <option value="manu_z_a" @if(request()->has('other_filter') &&
                                                request()->other_filter == 'manu_z_a') selected @endif>Manufacturer (Z
                                                to A)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!--nothingend-->

                    <div class="product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row">
                                    @if(count($all_products) > 0)
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
                                                    <h4 class="truncate-lines"> {{ $product->name }} </h4>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="danger">No Products Found</div>
                                    @endif
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
                                                    <img src="{{asset('frontend/images/img-pro')}}-01.jpg"
                                                        class="img-fluid" alt="Image">
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
                                                    <img src="{{asset('frontend/images/img-pro')}}-02.jpg"
                                                        class="img-fluid" alt="Image">
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
                                                    <img src="{{asset('frontend/images/img-pro')}}-03.jpg"
                                                        class="img-fluid" alt="Image">
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
@endif

<!-- End Shop Page -->
@endsection
@push('scripts')
<script>
    // docuemnt .load 

    var ssbuttonElement = document.getElementById('searchsuperbtn');
    ssbuttonElement.addEventListener('click', function() {
    
        var searchParams = new URLSearchParams(window.location.search);

        var manufacturerEle = document.querySelector('select[name="manufacturer"]');
        var manufacturer = manufacturerEle.value !== "" ? manufacturerEle.value : null;

        var sectorEle = document.querySelector('select[name="sector"]');
        var sector = sectorEle.value !== "" ? sectorEle.value : null;

        var categoryEle = document.querySelector('select[name="category"]');
        var category = categoryEle.value !== "" ? categoryEle.value : null;

        var indooroutdoorEle = document.querySelector('select[name="indoor_outdoor_filter"]');
        var indoor_outdoor_filter = indooroutdoorEle.value !== "" ? indooroutdoorEle.value : null;
      
        searchParams.set('searchresult', true);
        searchParams.set('manufacturer', manufacturer);
        searchParams.set('sector', sector);
        searchParams.set('category', category);
        searchParams.set('indoor_outdoor_filter', indoor_outdoor_filter)
        window.location.search = searchParams.toString()


});


    // $(document).ready(function() {
    //     // manufacturer filter
    //     $('.manufacturer_filter').click(function() {
    //         var manufacturer = [];
    //         $('.manufacturer_filter:checked').each(function() {
    //             manufacturer.push($(this).val());
    //         });
    //         manufacturer = manufacturer.toString();
    //         var searchParams = new URLSearchParams(window.location.search)
    //         searchParams.set('manufacturer', manufacturer)
    //         window.location.search = searchParams.toString()
    //     });
    //     $('.sector_filter').click(function() {
    //         var sector = [];
    //         $('.sector_filter:checked').each(function() {
    //             sector.push($(this).val());
    //         });
    //         sector = sector.toString();
    //         var searchParams = new URLSearchParams(window.location.search)
    //         searchParams.set('sector', sector)
    //         window.location.search = searchParams.toString()
    //     });
    //     $('.category_filter').click(function() {
    //         var category = [];
    //         $('.category_filter:checked').each(function() {
    //             category.push($(this).val());
    //         });
    //         category = category.toString();
    //         var searchParams = new URLSearchParams(window.location.search)
    //         searchParams.set('category', category)
    //         window.location.search = searchParams.toString()
    //     });
    //     $('.indoor_outdoor_filter').change(function() {
    //         $selected_value = $(this).val();
    //         var searchParams = new URLSearchParams(window.location.search)
    //         searchParams.set('indoor_outdoor_filter', $selected_value)
    //         window.location.search = searchParams.toString()
    //     });
    //     // showproducts_filter filter
    //     $('.showproducts_filter').change(function() {
    //         $selected_value = $(this).val();
    //         var searchParams = new URLSearchParams(window.location.search)
    //         searchParams.set('showproducts', $selected_value)
    //         window.location.search = searchParams.toString()
    //     });
    //     // other_filter filter
    //     $('.other_filter').change(function() {
    //         $selected_value = $(this).val();
    //         var searchParams = new URLSearchParams(window.location.search)
    //         searchParams.set('other_filter', $selected_value)
    //         window.location.search = searchParams.toString()
    //     });
     
    // });
</script>
@endpush
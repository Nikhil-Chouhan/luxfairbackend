
@extends('frontend.include.main')
@section('title', 'Home')

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
                    <h2><a href="index.html"><img src="{{asset('frontend/images/Home11.png')}}" class="see_11"></a> / <a href="{{route('frontend.manufacturers')}}">
                            Manufacturer</a></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                 

                <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active manufates" id="grid-view">
                                    <div class="row">
										@if(isset($all_manufacturers) && $all_manufacturers->count() > 0)
											@foreach($all_manufacturers as $key => $manufacturer)
												<div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
													<div class="products-single fix">
														<a href="/products?manufacturer={{$manufacturer->id}}">
															<div class="box-img-hover">
															 
															@if($manufacturer->image)
																<img src="{{asset($manufacturer->image)}}" class="img-fluid" alt="Image">
															@else
																<img src="{{asset('frontend/images/no-image.png')}}" class="img-fluid" alt="Image">
															@endif 
															</div>
															<div class="why-text">
																<h4>
																	{{$manufacturer->name}}
																</h4> 
															</div>
														</a>
													</div>
												</div> 
											@endforeach
										@endif
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
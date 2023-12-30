@extends('frontend.include.main')
@section('title', 'Home')
@section('headerclass', 'homepageheader')
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
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-1 luminaires">
                    <div class="box">
                        <h4>Luminaire<br /> Search</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="icons">
                                    <a href="{{ route('frontend.products') }}/?indoor_outdoor_filter=indoor">
                                        <img src="{{ asset('frontend/images/Indoors.png')}}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="icons">
                                    <a href="{{ route('frontend.products') }}/?indoor_outdoor_filter=outdoor">
                                        <img src="{{ asset('frontend/images/Outdoor.png')}}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="icons">
                                    <button class="non_bg_button" type="button" data-toggle="modal" data-target="#confirmationModal"><img src="{{ asset('frontend/images/supersearch.png')}}"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 luminaires1">
                    <div class="box1">
                        <p>A <span>seamless search</span></p>
                        <p><span>engine</span> to discover</p>
                        <p>the ideal <span>luminaire</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--sliderstart-->
    <section class="week">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  
                </div>
            </div>
        </div>
        <!--sliderend-->

        <!--sectorstart-->
        <div class="box-add-products arts_ee">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sector_h">
                            <h1>SECTOR</h1>
                            <h3>Explore our comprehensive range of electrical and lighting solutions. Find everything you need to illuminate and power up your spaces with cutting-edge technology and reliable products.
                            </h3>
                        </div>
                        <div class="three-column-images">
                        <div class="container ava_2 sectorin" >
								<div class="row justify-content-center">

								@if(isset($all_sector) && $all_sector->count() > 0)
											@foreach($all_sector as $key => $sector)

											<div class=" col-sm-2">
									      	<a href="/products?sector={{$sector->id}}" class="ava_1">
												@if($sector->image)
																<img src="{{asset($sector->image)}}" class="img-fluid" alt="Image">
															@else
																<img src="{{asset('frontend/images/no-image.png')}}" class="img-fluid" alt="Image">
															@endif 
													
															<p> <br> {{$sector->name}}</p>
											</a>
									         </div>
											@endforeach
										@endif

									
								
								</div> <!-- Row -->
								
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-add-products arts_ee">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sector_h">
                            <h1>CATEGORIES</h1>
                            <h3>Navigate through a diverse selection of electrical and lighting categories. Discover top-quality products tailored to meet your specific needs, ensuring a well-lit and powered environment for every application.
                            </h3>
                        </div>
                        <div class="three-column-images">
                        <div class="container ava_2 sectorin" >
								<div class="row justify-content-center">

								@if(isset($all_categories) && $all_categories->count() > 0)
											@foreach($all_categories as $key => $categories)

											<div class=" col-sm-2">
									      	<a target="_blank" class="ava_1">
												@if($categories->image)
																<img src="{{asset($categories->category_img)}}" class="img-fluid" alt="Image">
															@else
																<img src="{{asset('frontend/images/no-image.png')}}" class="img-fluid" alt="Image">
															@endif 
													
															<p> <br> {{$categories->category_title}}</p>
											</a>
									         </div>
											@endforeach
										@endif

									
								
								</div> <!-- Row -->
								
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--sectorend-->
        <!--story-->
        <div class="story_1">
            <div class="container">
                <div class="row ourstory">
                    <div class="col-md-5 offest-md-2 lum">
                        <div class="section_1">
                            <h4>OUR STORY <img src="{{ asset('frontend/images/storyicon.png')}}" class="ico_2" alt=""></h4>
                        </div>
                    </div>
                    <div class="col-md-5 offest-md-3 lum1">
                        <div class="section_2">
                            <h3>Born to transform lighting and power experiences, LuxFair has grown into a trusted hub for top-quality electrical products, driven by customer satisfaction and technological excellence.</h3>
                        </div><br /><br />
                        <div class="looo_1">
                            <p>LuxFair was born out of a vision to redefine the way people interact with lighting and power solutions. What started as a humble venture has evolved into a prominent destination for discerning customers seeking premium electrical products. Our journey has been marked by a relentless pursuit of excellence, a commitment to sourcing products from renowned manufacturers, and a dedication to staying at the forefront of technological advancements. As we continue to grow, our focus remains on providing our customers with reliable, innovative, and energy-efficient solutions to illuminate and power their spaces. Join us on this journey, and let's light up the world 
                            </p><br /><br />
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--story end-->
    </section>

    @endsection
    @push('script')
    <script>
    jQuery("#carousel").owlCarousel({
        autoplay: true,
        lazyLoad: true,
        loop: true,
        margin: 20,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        nav: true,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 3
            },

            1024: {
                items: 3
            },

            1366: {
                items: 3
            }
        }
    });
    </script>
    @endpush



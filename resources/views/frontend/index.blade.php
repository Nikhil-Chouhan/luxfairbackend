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
                                    <a href="supersearch.html"><img src="{{ asset('frontend/images/supersearch.png')}}"></a>
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
                    <div class="owl-slider head_h">
                        <h1>PRODUCTS OF THE WEEK</h1>
                        <div id="carousel" class="owl-carousel">
                            <div class="item tr ">
                                <img class="owl-lazy " data-src="{{ asset('frontend/images/home1.jpg')}}" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                <button>DETAILS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                        class="fa fa-caret-down"></i></button>
                            </div>
                            <div class="item tr">
                                <img class="owl-lazy " data-src="{{ asset('frontend/images/home2.jpg')}}" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                <button>DETAILS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                        class="fa fa-caret-down"></i></button>
                            </div>
                            <div class="item tr">
                                <img class="owl-lazy " data-src="{{ asset('frontend/images/home3.jpg')}}" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                <button>DETAILS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                        class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
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
                            <h3>Short and crisp headline
                                <br />to be placed here
                            </h3>
                        </div>
                        <div class="three-column-images">
                            <div class="container ava_2">
                                <div class="row">
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Aviation_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">Aviation</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Art&Culture_Dark')}}.png" alt="" />
                                        <a href="#" target="_blank">Arts & <br /> Culture</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/CommercialOffice_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">Commercial<br /> Office</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Educational_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">Education</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/ExternalArchitecture_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">External <br />Architecture</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Healthcare_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">Healthcare</a>
                                    </div>
                                </div> <!-- Row -->
                                <div class="row">
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Hotel&Wellness_Dark')}}.png" alt="" />
                                        <a href="#" target="_blank">Hotel &<br /> Wellness</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Industrial_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">Industrial</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Residential_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">Residential</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Retail_Dark.png')}}" alt="" />
                                        <a href="#" target="_blank">Retail</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Sports&Events_Dark')}}.png" alt="" />
                                        <a href="#" target="_blank">Sports &<br /> Events</a>
                                    </div>
                                    <div class=" col-sm-2">
                                        <img class="img-fluid" src="{{ asset('frontend/images/Transport&highway_Dark')}}.png" alt="" />
                                        <a href="#" target="_blank">Transport &<br /> Highways</a>
                                    </div>
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
                            <h3>Lorem ipsum dolor<br />
                                sit amet, consectetur<br />
                                adipiscing elit, desed<br />
                                do eiusmod
                            </h3>
                        </div><br /><br />
                        <div class="looo_1">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br />Vivamus ac molestie turpis.
                                Nulla facilisi. Donec at mauris<br />hendrerit, posuere augue ac, fermentum massa. Nulla
                                non<br />lectus elementum, efficitur leo ut, congue tellus.

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



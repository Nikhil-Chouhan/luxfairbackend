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

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><a href="{{route('frontend.home')}}"><img src="images/Home11.png" class="see_1"></a> / <a
                        href="superseacrh.html">Super Search</a></h2>

            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Gallery  -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Super Search</h1>
                </div>
            </div>
        </div>

        <div class="row special-list">
            <div class="col-lg-3 col-md-6 special-grid bulbs">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">SECTOR</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid fruits">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">MANUFACTURER</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid bulbs">
                <div class="products-single1 fix">

                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">FIXING OPTIONS</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 special-grid fruits">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">MOUNTING AREA</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 special-grid bulbs">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">LIGHT DISTRIBUTION</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid fruits">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">STRUCTURE TYPE </option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid podded-vegetables">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">DIMENTIONS</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid root-and-tuberous">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">COLOR TEMPERATURE</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid root-and-tuberous">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">CRI</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid podded-vegetables">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">MCADAM STEP ELIPSE</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid root-and-tuberous">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">TOTAL LUMENS</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid podded-vegetables">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">LIFETIME(L)+OUTPUT(B)</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid root-and-tuberous">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">ENVIRONMENT</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid podded-vegetables">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">WATTAGE</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid root-and-tuberous">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">VOLTAGE</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid podded-vegetables">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">CONTROLS</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid root-and-tuberous">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">DIMMING</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid podded-vegetables">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">WARRANTY</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid root-and-tuberous">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">LAMPTYPE</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 special-grid podded-vegetables">
                <div class="products-single1 fix">
                    <div class="credit-mob-rate">
                        <fieldset>
                            <select id="timeframe-select" class="timeframe" tabindex="-1">
                                <option value="1" selected="">OPTICS</option>
                                <option value="2">2 ani</option>
                                <option value="3">3 ani</option>
                                <option value="4">4 ani</option>
                                <option value="5">5 ani</option>
                            </select>
                            <span class="fa fa-caret-down"></span>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="myOverlay" class="overlay">
                    <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                    <div class="overlay-content">
                        <form action="/action_page.php">
                            <input type="text" placeholder="Search.." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>

                <button class="openBtn" onclick="openSearch()"><a href="aftersupersearch.html"> Search </a></button>
            </div>
        </div>
    </div>
</div>
<!-- End Gallery  -->

@endsection
@push('script')

@endpush
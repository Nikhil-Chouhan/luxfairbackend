
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
                    <h2><a href="index.html"><img src="{{asset('frontend/images/Home11.png')}}" class="see_1"></a> / <a href="{{route('frontend.sectors')}}">Sector</a></h2>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

   <!--sectorstart-->
		<div class="mynewsector">
			<div class="container shorts_q">
			
				<div class="row">
					<div class="col-md-12">
						<div class="sector_h crisp_1">
							<h1>SECTORS</h1>
							<h3>Short and crisp headline
							<br/>to be placed here</h3>
						</div> 
						<div class="three-column-images">
							<div class="container ava_2 sectorin" >
								<div class="row">
									<div class=" col-sm-2">
										<a   target="_blank" class="ava_1"><img class="img-fluid" src="{{asset('frontend/images/Aviation_Light.png')}}" alt="" />
										Aviation</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Art&Culture_Light')}}.png" alt="" />
										<a  target="_blank" class="ava_1">Arts & <br/> Culture</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/CommercialOffice_Light.png')}}" alt="" />
										<a  target="_blank" class="ava_1">Commercial<br/> Office</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Educational_Light.png')}}" alt="" />
										<a  target="_blank" class="ava_1">Education</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/ExternalArchitecture_Light.png')}}" alt="" />
										<a  target="_blank" class="ava_1">External <br/>Architecture</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Healthcare_Light.png')}}" alt="" />
										<a  target="_blank" class="ava_1">Healthcare</a>
									</div>
								</div> <!-- Row -->
								<div class="row">
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Hotel&Wellness_Light')}}.png" alt="" />
										<a  target="_blank" class="ava_1">Hotel &<br/> Wellness</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Industrial_Light.png')}}" alt="" />
										<a  target="_blank" class="ava_1">Industrial</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Residential_Light.png')}}" alt="" />
										<a  target="_blank" class="ava_1">Residential</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Retail_Light.png')}}" alt="" />
										<a  target="_blank" class="ava_1">Retail</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Sports&Events_Light')}}.png" alt="" />
										<a  target="_blank" class="ava_1">Sports &<br/> Events</a>
									</div>
									<div class=" col-sm-2">
										<img class="img-fluid" src="{{asset('frontend/images/Transport&highway_Light')}}.png" alt="" />
										<a  target="_blank" class="ava_1">Transport &<br/> Highways</a>
									</div>
								</div> <!-- Row -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!--sectorend-->

    @endsection
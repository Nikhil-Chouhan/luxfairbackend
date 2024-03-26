
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
                    <h2><a href="{{route('frontend.home')}}"><img src="{{asset('frontend/images/Home11.png')}}" class="see_1"></a> / <a href="{{route('frontend.sectors')}}">Sector</a></h2>
                   
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
	<!--sectorend-->

    @endsection
@extends('frontend.include.main')
@section('title', 'Home')

@section('content')

<style>
    .product_attr_group{
        font-size: 20px;
        font-weight: 600;
        color: #000;
        margin-bottom: 10px;
        background: #f5f5f5;
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
                <h2><a href="index.html"><img src="{{asset('frontend/images/Home11.png')}}" class="see_11"></a>/<a href="{{ route('frontend.products') }}">Products</a>/<a href="{{ route('frontend.product_detail', $product->slug) }}">{{ $product->name }}</a></h2>

            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->






<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div class="search-product">
                    <!--<form action="#">
                                <input class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>-->
                    <!--<h2><i class="fa fa-home" aria-hidden="true"></i>/Indoor/Decorative</h2>-->
                </div>
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"
                        class="detailpage">&nbsp;<i class="far fa-heart"></i></a>
                    <div class="carousel-inner" role="listbox">
                        @if($product->productgallery->count() > 0)

                       

                            @foreach($product->productgallery as $key=>$gallery)
                                @if($key == 0)
                                <div class="carousel-item active"> <img class="d-block w-100"
                                        src="{{ asset( $gallery->image) }}" alt="First slide"
                                        style="height: 400px; width: 400px;" /> </div>
                                @else
                                <div class="carousel-item"> <img class="d-block w-100" src="{{ asset( $gallery->image) }}"
                                        alt="slide" style="height: 400px; width: 400px;" /> </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <ol class="carousel-indicators">
                        @if($product->productgallery->count() > 0)

                        @foreach($product->productgallery as $key=>$gallery)
                        @if($key == 0)
                        <li data-target="#carousel-example-1" data-slide-to="{{$key}}" class="active">
                            <img class="d-block w-100 img-fluid" src="{{ asset( $gallery->image) }}" alt=""
                                style="height:75px; width: 25px;" />
                        </li>
                        @else
                        <li data-target="#carousel-example-1" data-slide-to="{{$key}}">
                            <img class="d-block w-100 img-fluid" src="{{ asset( $gallery->image) }}" alt=""
                                style="height:75px; width: 25px;" />
                        </li>
                        @endif
                        @endforeach
                        @endif

                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>
                        {{ $product->name }}
                    </h2>
                    <p>
                        {{ $product->short_description }}
                    </p>

                    <p>
                        {!! $product->long_description !!}
                    </p>

                    <div class="add-to-btn">
                        <div class="add-comp">
                            @if(checkIfInCompare($product->id))
                            
                            <a class="btn hvr-hover"  href="{{route('frontend.comparisions')}}"><i class="fas fa-exchange-alt"></i> Go to Compare</a>
                            @else
                            <a class="btn hvr-hover" onclick="add_to_compare({{ $product->id }})" href="javascript:void(0)"><i class="fas fa-exchange-alt"></i> Add to Compare</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--discription-->
<div class="container">
    <div class="row my-5">
        <div class="tabb_1">
            <div class="tab">
                <button class="tablinks descript1b active" onclick="openCity(event, 'London')">DESCRIPTION</button>
                <button class="tablinks descript" onclick="openCity(event, 'Paris')">MANUFACTURER</button>
            </div>

            <div id="London" class="tabcontent displayunable">
                
                <div class="row"> 
                    <div class="col-md-12">
                        <h2 class="product_attr_group">Product Details </h2>					
                        <p><b>Indoor / Outdoor  </b>: {{ $product->indoor_outdoor }}</p>
                        <p><b>Sector</b>: 
    @php
        $sectorIds = explode(',', $product->sector_id);
        $sectors = App\Models\Sector::whereIn('id', $sectorIds)->pluck('name')->toArray();
        echo implode(', ', $sectors);
    @endphp
</p>
                        <p><b>Category:</b> {{ optional($product->category)->category_title ?? "-" }}</p>
                        <p><b>SubCategory:</b> {{ optional($product->subcategory)->subcategory_title ?? "-" }}</p>
                        <p><b>Manufacturer </b>: {{ $product->manufacturer->name }}</p>
                        <p><b>Luminaire Product Name </b>: {{ $product->name }}</p>
                        <p><b>Luminaire Product Code </b>: {{ $product->code }}</p> 
                        <p><b>Luminaire Design </b>: {{ $product->design }}</p>
                        <p><b>Luminaire Connection </b>: {{ $product->connection }}</p>
                        <p><b>Luminaire Installation </b>: {{ $product->installation }}</p>  
                    </div> 
                    @foreach($product_arr  as $key => $value)

                        <div class="col-md-12">
                            <h2 class="product_attr_group">{{ ucfirst($key) }}</h2>	 
                            @foreach($value  as $key => $item)
                            <p><b>{{ucfirst($item['name'])}}</b>:
                            {{getProductMetaValue ($product->id, $item['id'])}}
                        
                            </p> 
                            @endforeach 
                            
                        </div> 
                    @endforeach
                </div>
            </div>
            <div id="Paris" class="tabcontent">
                <h3>MANUFACTURER</h3>
                @if($product->manufacturer->image)
                    <img src="{{ asset($product->manufacturer->image ) }}" class="img-fluid" alt="Image">
                @endif
                <p>
                    {{ $product->manufacturer->name }}
                </p>
                
                <p>
                    {{ $product->manufacturer->description }}
                </p>
                
            </div>
        </div>
    </div>
</div>
<!--discription-->


<!--<div class="row my-5">
				<div class="card card-outline-secondary my-4">
					<div class="card-header">
						<h2>Product Reviews</h2>
					</div>
					<div class="card-body">
						<div class="media mb-3">
							<div class="mr-2"> 
								<img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
							</div>
							<div class="media-body">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
								<small class="text-muted">Posted by Anonymous on 3/1/18</small>
							</div>
						</div>
						<hr>
						<div class="media mb-3">
							<div class="mr-2"> 
								<img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
							</div>
							<div class="media-body">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
								<small class="text-muted">Posted by Anonymous on 3/1/18</small>
							</div>
						</div>
						<hr>
						<div class="media mb-3">
							<div class="mr-2"> 
								<img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
							</div>
							<div class="media-body">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
								<small class="text-muted">Posted by Anonymous on 3/1/18</small>
							</div>
						</div>
						<hr>
						<a href="#" class="btn hvr-hover">Leave a Review</a>
					</div>
				  </div>
			</div>-->
<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="title-all text-center mysimilar">
                <h1>Similar products</h1>

            </div>
            <div class="featured-products-box owl-carousel owl-theme">
                @if($similar_products->count() > 0)
                    @foreach($similar_products as $product)
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img  src="{{ asset( $product->image) }}" class="img-fluid img_feat" alt="Image">
                                    <div class="type_s">
                                        <i class="far fa-heart"></i>
                                    </div> 
                                </div>
                                <div class="why-text">
                                    <h4>
                                        <a href="{{ route('frontend.product_detail', $product->slug) }}">{{ $product->name }}</a>
                                    </h4> 
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                 
            </div>

        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="seeall">
            <p><a href="">See All</a></p>
        </div>
    </div>
</div>
</div>
</div>
<!-- End Cart -->

@endsection

@push('scripts')
<script>
function add_to_compare(product_id) {
    $.ajax({
        url: "{{ route('frontend.add_to_compare') }}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "product_id": product_id
        },
        success: function(response) {
            if (response.status) {
                $.toast({
                        heading: 'Success',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'info',
                        loaderBg: '#46c35f',
                        position: 'top-right'
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 100);
            } else {
                $.toast({
                        heading: 'Error',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#46c35f',
                        position: 'top-right'
                    });
            }
        }
    });
    
}
</script>


@endpush


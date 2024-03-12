

<style>
    .accordion .card:last-of-type{
        border-bottom: 1px solid #ddd;
    }

    .shop-box-inner {
        min-height: unset !important;
    }

</style>

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container-fluid">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                     <h4> Search Result:</h4>
                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @if(count($all_products) > 0)
                                        @foreach($all_products as $product)

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
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
                                        @else 
                                          <p>No Product Found!</p>
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

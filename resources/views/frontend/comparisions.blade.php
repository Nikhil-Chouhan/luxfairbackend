@extends('frontend.include.main')
@section('title', 'Home')

@section('content')

<style>
    .hd_1{
        min-height: 90px;
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
                <h2><a href="/"><img src="{{asset('frontend/images/Home11.png')}}" class="see_1"></a> / <a
                        href="{{ route('frontend.comparisions') }}" class="see_1">COMPARE</a></h2>

            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Contact Us  -->
<div class="container">
    <div class="row ficture_s">
        <div class="col-md-12">

            <div class="compare_ee">
                <h2>COMPARE</h2>
              

                @if(!auth()->check()) 
                    <p class="text-center">
                        <a style="color:blue" href="http://"> Sign up</a> to compare more Products
                    </p>
                @endif 
            </div>
            <div class="row">
                @if(count($all_comparisions) > 0)
                    @foreach($all_comparisions as $comparision)
                        <div class="col-md-3">
                            <div class="product product_1 trs " id="myBtn">
                                <a href="{{ route('frontend.comparisions.clear', $comparision->id) }}">
                                    <img src="{{asset('frontend/images/close.png')}}" class="close_1">
                                </a>
                                <div class="call">
                                    <img src="{{ asset($comparision->product->image) }}"
                                    class="img-fluid" alt="Image">
                                    <h2 class="fixt_1">
                                        <a href="#">
                                            {{
                                                $comparision->product->name
                                            }}
                                        </a>
                                    </h2>
                                </div>
                                <ul class="htype_1">
                                    <li class="ht_1">Indoor / Outdoor</li>
                                    <li class="hd_1">
                                        @if($comparision->product->indoor_outdoor == 'indoor')
                                            Indoor
                                        @else
                                            Outdoor
                                        @endif
                                    </li> 
                                    <li class="ht_1">Category</li>
                                    <li class="hd_1">
                                        {{optional($comparision->product->category)->category_title ?? "-"}}
                                    </li>
                                    <li class="ht_1">SubCategory</li>
                                    <li class="hd_1">
                                        {{optional($comparision->product->subcategory)->subcategory_title ?? "-" }}
                                    </li>
                                    <li class="ht_1">Sector</li>
                                    <li class="hd_1">
    @php
        $sectorIds = explode(',', $comparision->product->sector_id);
        $sectors = App\Models\Sector::whereIn('id', $sectorIds)->pluck('name')->toArray();
        echo implode(', ', $sectors);
    @endphp
                                    </li>
                                    <li class="ht_1">Manufacturer</li>
                                    <li class="hd_1">
                                        {{$comparision->product->manufacturer->name}}
                                    </li> 
                                    <li class="ht_1">Louvre / Diffuser / Reflector</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Louvre / Diffuser / Reflector')
                                        }}
                                    </li> 
                                    <li class="ht_1">Colour</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Colour')
                                        }}
                                    </li> 
                                    <li class="ht_1">Dimensions: Length, Width, Height, Diameter</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Dimensions: Length, Width, Height, Diameter')
                                        }}
                                    </li> 
                                    <li class="ht_1">Weight</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Weight')
                                        }}
                                    </li> 
                                    <li class="ht_1">Luminaire Variations</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Luminaire Variations')
                                        }}
                                    </li> 
                                    <li class="ht_1">Light Source</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Light Source')
                                        }}
                                    </li> 
                                    <li class="ht_1">Lumen Output</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Lumen Output')
                                        }}
                                    </li> 
                                    <li class="ht_1">Light Distribution</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Light Distribution')
                                        }}
                                    </li> 
                                    <li class="ht_1">Beam Angle</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Beam Angle')
                                        }}
                                    </li> 
                                    <li class="ht_1">Colour Temperature</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Colour Temperature')
                                        }}
                                    </li> 
                                    <li class="ht_1">Colour Rendering Index (CRI)</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Colour Rendering Index (CRI)')
                                        }}
                                    </li> 
                                    <li class="ht_1">Lamp Life Time (hours)</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Lamp Life Time (hours)')
                                        }}
                                    </li> 
                                    <li class="ht_1">MacAdam Step</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'MacAdam Step')
                                        }}
                                    </li> 
                                    <li class="ht_1">Protective Class</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Protective Class')
                                        }}
                                    </li> 
                                    <li class="ht_1">IP Rating</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'IP Rating')
                                        }}
                                    </li> 
                                    <li class="ht_1">IK Rating</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'IK Rating')
                                        }}
                                    </li> 
                                    <li class="ht_1">Minimum Ambient Temperature</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Minimum Ambient Temperature')
                                        }}
                                    </li> 
                                    <li class="ht_1">Maximum Ambient Temperature</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Maximum Ambient Temperature')
                                        }}
                                    </li> 
                                    <li class="ht_1">Dimming Mode</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Dimming Mode')
                                        }}
                                    </li> 
                                    <li class="ht_1">Rated Supply Voltage</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Rated Supply Voltage')
                                        }}
                                    </li> 
                                    <li class="ht_1">System Wattage (watts)</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'System Wattage (watts)')
                                        }}
                                    </li> 
                                    <li class="ht_1">Inrush Current</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Inrush Current')
                                        }}
                                    </li> 
                                    <li class="ht_1">Standby Power</li>
                                    <li class="hd_1">
                                        {{
                                            getProductMetaValueFromName($comparision->product->id, 'Standby Power')
                                        }}
                                    </li> 
                                </ul>
                                <!-- <button>Select </button> -->
                            </div>
                        </div> 
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</div>

<!-- End Instagram Feed  -->

@endsection
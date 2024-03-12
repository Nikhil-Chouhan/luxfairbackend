
    <!-- Start Main Top -->
    <header class="main-header @yield('headerclass','')">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                        aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="/"><img src="{{ asset('frontend/images/logo.png')}}" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item  @if(Request::is('/')) active @endif"><a class="nav-link" href="/">Home</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="sector.html">Sector</a></li> -->
                        <li class="nav-item @if(Request::is('sectors')) active @endif"><a class="nav-link" href="{{ route('frontend.sectors') }}">Sector</a></li>
                        <li class="nav-item @if(Request::is('products')) active @endif"><a href="{{ route('frontend.products') }}" class="nav-link">Product</a></li>
                        <li class="nav-item @if(Request::is('manufacturers')) active @endif"><a class="nav-link" href="{{ route('frontend.manufacturers') }}">Manufacturer</a></li>
                        <li class="nav-item @if(Request::is('comparisions')) active @endif"><a class="nav-link" href="{{ route('frontend.comparisions') }}">Compare</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <!-- <li class="search">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#superSearchModal" > <i class="fa fa-search"></i></a>
                        </li> -->

                        <li class="search">
                            <a href="{{ route('frontend.supersearch') }}">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="search2">
                        @if(Auth::check())
                            <a href="{{ route('logout') }}">
                                <!-- logout  -->
                                <i class="fa fa-power-off" ></i>
                                
                            </a>
                        @else
                            <a href="{{ route('frontend.login') }}">
                            <!-- icon  -->
                            <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                        @endif
                        </li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div> 
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

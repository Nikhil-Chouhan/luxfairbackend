<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" style="    width: 5em;" title="luxfair"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment2 == 'inventory') ? 'active' : '' }}">
                    <a href="{{url('admin//inventory')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>

                <!-- start inventory pages -->

                <div class="nav-item {{ ($segment1 == 'products') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-headphones"></i><span>{{ __('Products')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('admin/products/create')}}" class="menu-item {{ ($segment1 == 'products' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Product')}}</a>
                        <a href="{{url('admin/products')}}" class="menu-item {{ ($segment1 == 'products' && $segment2 == '') ? 'active' : '' }}">{{ __('List Producs')}}</a>
                    </div>
                </div>
                @can('manage_category')
                <div class="nav-item {{ ($segment1 == 'categories') ? 'active' : '' }}">
                    <a href="{{url('admin/categories')}}"><i class="ik ik-list"></i><span>{{ __('Categories')}}</span></a>
                </div>
                @endcan
                
                @can('manage_subcategory')
                <div class="nav-item {{ ($segment1 == 'subcategories') ? 'active' : '' }}">
                    <a href="{{url('admin/subcategories')}}"><i class="ik ik-list"></i><span>{{ __('Sub Categories')}}</span></a>
                </div>

                @endcan
                
                @can('manage_product_attributes')
                <div class="nav-item {{ ($segment1 == 'product_attributes') ? 'active' : '' }}">
                    <a href="{{url('admin/product_attributes')}}"><i class="ik ik-list"></i><span>{{ __('Product Attributes')}}</span></a>
                </div>
                @endcan
                @can('manage_manufacturers')
                <div class="nav-item {{ ($segment1 == 'manufacturers') ? 'active' : '' }}">
                    <a href="{{url('admin/manufacturers')}}"><i class="ik ik-list"></i><span>{{ __('Manufacturers')}}</span></a>
                </div>
                @endcan 



                <!-- end inventory pages -->

                
        </div>
    </div>
</div>
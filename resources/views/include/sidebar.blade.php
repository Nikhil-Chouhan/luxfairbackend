<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo.png')}}" class="header-brand-img" style="width:100%" title="luxfair"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(2);
        $segment2 = request()->segment(3);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>  
                
                <div class="nav-item {{ ($segment1 == 'products') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-headphones"></i><span>{{ __('Products')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('admin/products/create')}}" class="menu-item {{ ($segment1 == 'products' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Product')}}</a>
                        <a href="{{url('admin/products')}}" class="menu-item {{ ($segment1 == 'products' && $segment2 == '') ? 'active' : '' }}">{{ __('List Products')}}</a>
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
                @can('manage_sector')
                <div class="nav-item {{ ($segment1 == 'sector') ? 'active' : '' }}">
                    <a href="{{url('admin/sector')}}"><i class="ik ik-list"></i><span>{{ __('Sector')}}</span></a>
                </div>
                @endcan 
                @can('manage_menus')
                <div class="nav-item {{ ($segment1 == 'header_menus') ? 'active' : '' }}">
                    <a href="{{url('admin/header_menus')}}"><i class="ik ik-list"></i><span>{{ __('Header Menus')}}</span></a>
                </div>
                @endcan 
                @can('manage_menus')
                <div class="nav-item {{ ($segment1 == 'footer_menus') ? 'active' : '' }}">
                    <a href="{{url('admin/footer_menus')}}"><i class="ik ik-list"></i><span>{{ __('Footer Menus')}}</span></a>
                </div>
                @endcan 
                @can('manage_custompages')
                <div class="nav-item {{ ($segment1 == 'custompages') ? 'active' : '' }}">
                    <a href="{{url('admin/custompages')}}"><i class="ik ik-list"></i><span>{{ __('Custom Pages')}}</span></a>
                </div>
                @endcan 

                @can('manage_user' || 'manage_roles' || 'manage_permission')
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_user')
                        <a href="{{url('admin/users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('admin/user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('manage_roles')
                        <a href="{{url('admin/roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('manage_permission')
                        <a href="{{url('admin/permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        @endcan
                    </div>
                </div> 
                @endcan 

        </div>
    </div>
</div>
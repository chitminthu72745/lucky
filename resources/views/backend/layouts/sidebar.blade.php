<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('admin.home') }}" class="@yield('dashboard')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="mm-active">
                    <a href="#" class="@yield('products') close_products">
                        <i class="metismenu-icon pe-7s-shopbag"></i>
                            Products
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul class="@yield('products_expanded') hide_products">
                        <li>
                            <a href="{{route('admin.products.index')}}" class="@yield('all_product')">
                                <i class="metismenu-icon"></i>
                                All Products
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.products.create')}}" class="@yield('create_product')">
                                <i class="metismenu-icon"></i>
                                Add New Products
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.category.index')}}" class="@yield('category')">
                                <i class="metismenu-icon"></i>
                                Categories
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.tag.index')}}" class="@yield('tag')">
                                <i class="metismenu-icon"></i>
                                Tags
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.attribute.index')}}" class="@yield('attribute')">
                                <i class="metismenu-icon"></i>
                                Attributes
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">UI Components</li>
                <li>
                    <a href="#" class="@yield('user')">
                        <i class="metismenu-icon pe-7s-users"></i>
                            User Management
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.all-user.index')}}" class="@yield('all-user')">
                                <i class="metismenu-icon"></i>
                                All User
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.all-user.create')}}" class="@yield('user-create')">
                                <i class="metismenu-icon"></i>
                                Add New User
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div> 
@section('script')
    <script>
        $('.hide_products').hide(200);
        $('.close_products').click(function(e){
            e.preventDefault();
            $('.hide_products').hide(200);
        });
    </script>
@endsection
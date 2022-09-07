<div class="iq-sidebar sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="" class="header-logo">
            <img src="{{ asset('./images/logo.png') }}" class="img-fluid rounded-normal light-logo" alt="logo" />
            <h4 class="logo-title ml-3">Vali-Teach</h4>
        </a>
        <div class="iq-menu-bt-sidebar">
            <i class="las la-times wrapper-menu"></i>
        </div>
    </div>
    <div class="sidebar-caption dropdown">
        <a href="#" class="iq-user-toggle d-flex align-items-center justify-content-between" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset(Auth::user()->img_path) }}" class="img-fluid rounded avatar-50 mr-3" alt="user" />
            <div class="caption">
                <h6 class="mb-0 line-height">{{ Auth::user()->fish }}</h6>
            </div>
            <i class="las la-angle-down"></i>
        </a>
        <div class="dropdown-menu w-100 border-0 my-2" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="las la-sign-out-alt font-size-20 mr-1"></i>
                <span>Chiqish</span>
            </a>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                @can('admin')
                @include('layouts.links',['route' => route('products.index'),'linkname' => "Maxsulotlar",])
                @include('layouts.links',['route' => route('categories.index'),'linkname' => "Kategoriyalar",])
                @include('layouts.links',['route' => route('statistic.index'),'linkname' => "Xisobot",])
                @endcan
                @can('sotuvchi')
                @include('layouts.links',['route' => route('basket.index'),'linkname' => "Sotuv bo'limi",])
                @include('layouts.links',['route' => route('statistic.index'),'linkname' => "Xisobot",])
                @endcan
                @can('direktor')
                @include('layouts.links',['route' => route('products.index'),'linkname' => "Maxsulotlar",])
                @include('layouts.links',['route' => route('categories.index'),'linkname' => "Kategoriyalar",])
                @include('layouts.links',['route' => route('register.index'),'linkname' => "Xodimlar",])
                @include('layouts.links',['route' => route('basket.index'),'linkname' => "Sotuv bo'limi",])
                @include('layouts.links',['route' => route('statistic.index'),'linkname' => "Xisobot",])
                @endcan
            </ul>
        </nav>
    </div>
</div>
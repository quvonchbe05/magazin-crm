<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <i class="fas fa-3x fa-th tm-site-icon"></i>
        <h1 class="tm-site-title mb-0"><i>AdminPanel</i></h1>
    </a>
    <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            @include('layouts.links', ['route' => route('current'), 'linkname' => 'Текущая время'])
            @include('layouts.links', ['route' => route('products.index'), 'linkname' => 'Продукты'])
            @include('layouts.links', ['route' => route('users.index'), 'linkname' => 'Пользователи'])
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user pr-2"></i>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}">Выйти</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


{{-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Settings
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="">Profile</a>
    </div>
</li> --}}

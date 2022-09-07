<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vali-Teach | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('./css/backend.css?v=1.0.0') }}" />
    <link rel="stylesheet" href="{{ asset('./css/myscc.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('./vendor/remixicon/fonts/remixicon.css"') }}" />
</head>

<body class="noteplus-layout">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <div class="wrapper">
        @include('layouts.topnav')
        @include('layouts.navigation')
        <div class="content-page">
            <div class="container-fluid note-details">
                <div class="desktop-header">
                    <div class="card card-block topnav-left">
                        <div class="card-body write-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="iq-note-callapse-menu">
                                    <h3>@yield('content__title')</h3>
                                </div>
                                @can('admin')                
                                <button onclick="print()" class="btn btn-primary">Print</button>
                                @endcan
                                @can('direktor')                
                                <button onclick="print()" class="btn btn-primary">Print</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Wrapper End-->
        <footer class="iq-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="">Vali-Teach IT Group</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="text-secondary mr-1">
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            ©
                        </span>
                        <a href="#" class="">Quvonchbek Murodov</a>.
                    </div>
                </div>
            </div>
        </footer>
        <script src="{{ asset('./js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('./js/backend-bundle.min.js') }}"></script>
        <script src="{{ asset('./js/app.js') }}"></script>
        @yield('script')
</body>

</html>
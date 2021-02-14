<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

     <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
    </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
       <header>
            <nav class="navbar navbar-expand-md navbar-white fixed-top bg-white">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="{{asset('banner/logo.jpg')}}" alt="" srcset="" width="100" height="50">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item active">
                                <a class="nav-link text-muted" aria-current="page" href="#">Mitra Sukses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-muted" href="#">Peluang Sukses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-muted disabled" href="#" tabindex="-1" aria-disabled="true">Program</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-muted disabled" href="#" tabindex="-1" aria-disabled="true">Promo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-muted disabled" href="#" tabindex="-1" aria-disabled="true">Galeri</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
       </header>

        <main>
            @yield('content')
        </main>

        <div class="bg-info px-4 py-4">
            <div>
                <h4>Kantor Pusat</h4>
                <h4>Belum ketauan alamatnya dimana</h4>
            </div>
            <div>
                <h4>Email</h4>
                <h4>Xample@mail.com</h4>
            </div>
        </div>
    </div>
</body>
</html>

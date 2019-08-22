<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="appear-animate">
    <!-- Page Loader -->
    <div class="page-loader">
        <div class="loader">Loading...</div>
    </div>
    <!-- End Page Loader -->

    <!-- Page Wrap -->
    <div class="page" id="top">
        @include('includes.header')

        @yield('content')

        @include('includes.footer')
    </div>
    <!-- End Page Wrap -->

    <!-- Scripts -->
    <script>
      let appLocale = '{{ \App::getLocale() }}';
    </script>

    <!-- JS -->
    <script src="{{ asset('js/theme/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/theme/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/theme/SmoothScroll.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.localScroll.min.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.viewport.mini.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.countTo.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.appear.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.parallax-1.1.3.js') }}"></script>
    <script src="{{ asset('js/theme/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/theme/jquery.fitvids.js') }}"></script>
    <script src="{{ asset('js/theme/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/theme/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/theme/wow.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js_includes')
</body>
</html>

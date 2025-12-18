<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inventory System')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.theme.green.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.theme.green.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.css') }}">
     <link rel=" stylesheet" href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    @stack('styles')
</head>
<body>
    {{-- @include('partials.navbar')
    @include('partials.sidebar') --}}

    <div class="main-content">
        @yield('content')
    </div>

    {{-- @include('partials.footer') --}}
    <script src="{{ asset('assets/lib/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')

</body>

</html>
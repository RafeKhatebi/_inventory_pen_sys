<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Inventory System')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        @include('partials.navbar')

        <!-- Alerts -->
        @include('partials.alerts')

        <!-- Main Content Area -->
        <div class="container-fluid mt-3">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('partials.footer')
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/dist/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
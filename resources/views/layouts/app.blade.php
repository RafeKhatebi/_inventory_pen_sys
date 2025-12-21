<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Inventory System')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        document.querySelector('.sidebar-toggler').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('open');
            document.querySelector('.content').classList.toggle('open');
        });

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function (event) {
            const sidebar = document.querySelector('.sidebar');
            const toggler = document.querySelector('.sidebar-toggler');
            const isMobile = window.innerWidth <= 768;

            if (isMobile && sidebar.classList.contains('open') &&
                !sidebar.contains(event.target) &&
                !toggler.contains(event.target)) {
                sidebar.classList.remove('open');
                document.querySelector('.content').classList.remove('open');
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>

</html>
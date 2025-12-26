<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')  مدیریت گدام</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    @stack('styles')
</head>

<body>
    @yield('content')
    <!-- Bootstrap JS Bundle -->
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function () {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
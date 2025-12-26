<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-3">
    <a href="{{ url('/') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <!-- Search Form -->
    <form method="GET" action="{{ route('products.index') }}" class="d-flex">
        <input type="search" name="search" class="form-control" placeholder="جستجوی محصولات..."
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-primary ms-2">
            <i class="fa fa-search"></i>
        </button>
        @if(request('search'))
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary ms-1">
                <i class="fa fa-times"></i>
            </a>
        @endif
    </form>
    <div class="navbar-nav align-items-center ms-auto">

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2"
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                    alt="Admin" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="{{route('profile')}}" class="dropdown-item">
                    <i class="fa fa-user me-2"></i> پروفایل من
                </a>
                <hr class="dropdown-divider">
                <!-- In navbar.blade.php -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fa fa-sign-out-alt me-2"></i> خروج
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
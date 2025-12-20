<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-3">
    <a href="{{ url('/') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search products, customers...">
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notifications</span>
                <span class="badge bg-primary rounded-pill">5</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="/stocks" class="dropdown-item">
                    <h6 class="fw-normal mb-0">⚠️ 3 products low in stock</h6>
                    <small>Just now</small>
                </a>
                <a href="/customers" class="dropdown-item">
                    <h6 class="fw-normal mb-0">👥 New customer registered</h6>
                    <small>15 minutes ago</small>
                </a>
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">💰 Credit payment overdue</h6>
                    <small>2 hours ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2"
                    src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff" alt="Admin"
                    style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">Admin User</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="/profile" class="dropdown-item">
                    <i class="fa fa-user me-2"></i> My Profile
                </a>

                <hr class="dropdown-divider">
                <!-- In navbar.blade.php -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
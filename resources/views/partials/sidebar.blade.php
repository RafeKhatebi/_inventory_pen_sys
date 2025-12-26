<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <!-- Logo and User Profile on same line -->
        <div class="d-flex justify-content-between align-items-center mx-4 mb-3">
            <!-- Logo/Brand -->
            <a href="{{ route('dashboard') }}" class="navbar-brand p-0 m-0">
                <h3 class="text-primary m-0">
                    <i class="fa fa-boxes me-2"></i>{{ config('app.name', 'انبارداری') }}
                </h3>
            </a>
        </div>
        <!-- User Info Below -->
        <div class="px-4 mb-4">
            <div class="text-center">
                <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
                <span class="text-primary small">{{ Auth::user()->email }}</span>
            </div>
        </div>

        <!-- Rest of your navigation menu stays the same -->
        <div class="navbar-nav w-100 px-3">
            <!-- ... all your nav items here ... -->
            <div class="navbar-nav w-100">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt me-2"></i>داشبورد
                </a>
                <!-- Products -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('products.*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-box me-2"></i>محصولات
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('products.index') }}"
                            class="dropdown-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
                            <i class="fa fa-list me-2"></i>تمام محصولات
                        </a>
                        <a href="{{ route('products.create') }}"
                            class="dropdown-item {{ request()->routeIs('products.create') ? 'active' : '' }}">
                            <i class="fa fa-plus-circle me-2"></i>افزودن محصول جدید
                        </a>
                    </div>
                </div>
                <!-- Inventory -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('stocks.*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-warehouse me-2"></i>انبار
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('stocks.index') }}"
                            class="dropdown-item {{ request()->routeIs('stocks.index') ? 'active' : '' }}">
                            <i class="fa fa-boxes me-2"></i>نمای کلی موجودی
                        </a>
                        <a href="{{ route('stocks.in') }}"
                            class="dropdown-item {{ request()->routeIs('stocks.in') ? 'active' : '' }}">
                            <i class="fa fa-arrow-down me-2"></i>ورود کالا
                        </a>
                        <a href="{{ route('stocks.out') }}"
                            class="dropdown-item {{ request()->routeIs('stocks.out') ? 'active' : '' }}">
                            <i class="fa fa-arrow-up me-2"></i>خروج کالا
                        </a>
                        <a href="{{ route('stocks.history') }}"
                            class="dropdown-item {{ request()->routeIs('stocks.history') ? 'active' : '' }}">
                            <i class="fa fa-history me-2"></i>تاریخچه موجودی
                        </a>
                    </div>
                </div>
                <!-- Customers -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('customers.*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-users me-2"></i>مشتریان
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('customers.index') }}"
                            class="dropdown-item {{ request()->routeIs('customers.index') ? 'active' : '' }}">
                            <i class="fa fa-list me-2"></i>تمام مشتریان
                        </a>
                        <a href="{{ route('customers.create') }}"
                            class="dropdown-item {{ request()->routeIs('customers.create') ? 'active' : '' }}">
                            <i class="fa fa-user-plus me-2"></i>افزودن مشتری
                        </a>
                    </div>
                </div> <!--Transactions -->
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link dropdown-toggle {{ request()->routeIs('transactions.*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-exchange-alt me-2"></i>تراکنشها
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('transactions.index') }}"
                            class="dropdown-item {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                            <i class="fa fa-exchange-alt me-2"></i>تراکنشها
                        </a>
                        <a href="{{ route('transactions.create') }}"
                            class="dropdown-item {{ request()->routeIs('transactions.create') ? 'active' : '' }}">
                            <i class="fa fa-plus-circle me-2"></i>افزودن تراکنش
                        </a>
                    </div>
                </div>
                <!-- Reports -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('reports.*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-chart-bar me-2"></i>گزارشها
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('reports.inventory.index') }}"
                            class="dropdown-item {{ request()->routeIs('reports.inventory.index') ? 'active' : '' }}">
                            <i class="fa fa-warehouse me-2"></i>گزارش انبار
                        </a>
                        <a href="{{ route('reports.customers.index') }}"
                            class="dropdown-item {{ request()->routeIs('reports.customers.index') ? 'active' : '' }}">
                            <i class="fa fa-users me-2"></i>گزارش مشتریان</a>
                        <a href="{{ route('reports.complete-summary.index') }}"
                            class="dropdown-item {{ request()->routeIs('reports.complete-summary.index') ? 'active' : '' }}">
                            <i class="fa fa-chart-line me-2"></i>گزارش کامل
                        </a>
                    </div>
                </div>
                {{-- Users --}}
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('users.*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-user-cog me-2"></i>کاربران
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('users.index') }}"
                            class="dropdown-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                            <i class="fa fa-users me-2"></i>تمام کاربران
                        </a>
                        <a href="{{ route('users.create') }}"
                            class="dropdown-item {{ request()->routeIs('users.create') ? 'active' : '' }}">
                            <i class="fa fa-user-plus me-2"></i>افزودن کاربر
                        </a>
                    </div>
                </div>
                <!-- Backup & Restore -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('backup.*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">
                        <i class="fa fa-database me-2"></i>پشتیبان
                    </a>
                    <div class="dropdown-menu bg-transparent border-0">

                        <a href="{{ route('backup.index') }}"
                            class="dropdown-item {{ request()->routeIs('backup.index') ? 'active' : '' }}">
                            <i class="fa fa-database me-2"></i>پشتیبان و بازیابی
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse" style="top: 0">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
                </a>
            </li>
        
        </ul>

        {{-- Master Data --}}
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>Master Data</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('category*') ? 'active' : '' }}" href="{{ route('category.index') }}">
                <i class="fa-solid fa-list-ul"></i>
                Device Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                <i class="fa-solid fa-people-group"></i>
                User Account
                </a>
            </li>
        </ul>

        {{-- Device --}}
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>Device</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link text-success" href="{{ route('device.create') }}">
                <i class="fa-solid fa-plus"></i>
                Add new device
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('device*') ? 'active' : '' }}" href="{{ route('device.index') }}">
                <i class="fa-solid fa-desktop"></i>
                All Device
                </a>
            </li>
        </ul>

        {{-- Account --}}
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>Account</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user/setting') ? 'active' : '' }}" href="{{ route('user.setting') }}">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                Settings
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('auth.logout') }}" method="post" id="logout">
                    @csrf

                    <button type="submit" class="nav-link text-danger"><i class="fa-solid fa-door-open"></i> Logout</button>
                </form>
            </li>
        </ul>

        {{-- sidebar list with title --}}
        {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>List Title</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('') ? 'active' : '' }}" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                List Item
                </a>
            </li>
        </ul> --}}
    </div>
</nav>
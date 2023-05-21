<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse" style="top: 0">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="#">
                <i class="fa-solid fa-house"></i>
                Dashboard
                </a>
            </li>
        
        </ul>

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
        </ul>


        {{-- sidebar list with title --}}
        {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
            <span>List Title</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                List Item
                </a>
            </li>
        </ul> --}}
    </div>
</nav>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
     id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        @if(Auth::check() && Auth::user()->role && Auth::user()->role->slug === 'admin')
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0">
                <span class="app-brand-text menu-text fw-bold ms-2">Admin Dashboard</span>
            </div>
        @elseif(Auth::check() && Auth::user()->role && Auth::user()->role->slug === 'health-worker')
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0">
                <span class="app-brand-text menu-text fw-bold ms-2">Health Worker Dashboard</span>
            </div>
        @elseif(Auth::check() && Auth::user()->role && Auth::user()->role->slug === 'parent')
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0">
                <span class="app-brand-text menu-text fw-bold ms-2">Parent/Guardian Dashboard</span>
            </div>
        @endif
        <!-- /Search -->
    </div>


    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <!-- <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..."/>
            </div>
        </div> -->
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">

                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img
                            src="{{ !empty(Auth::user()->image) ? url(Auth::user()->image) : url('images/default.png') }}"
                            alt class="w-px-40 h-auto rounded-circle"/>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ !empty(Auth::user()->image) ? url(Auth::user()->image) : url('images/default.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle"/>

                                            
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span
                                        class="fw-medium d-block">{{ !empty(Auth::user()->name) ? Auth::user()->name : 'N/A' }}</span>
                                    <small
                                        class="text-muted">{{ !empty(Auth::user()->role->title) ? Auth::user()->role->title : 'N/A' }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.view') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>


<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="app-brand-link">
           <h3 style="color:#5f61e6; font-weight:bold;z"> <i class="fas fa-syringe me-2"></i>VaxTracker</h3>
        </a>
{{--        <a href="" class="navbar-brand">--}}
{{--            <h2 class="m-0 text-primary">VaxTracker</h2>--}}
{{--        </a>--}}

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('dashboard') || Request::is('dashboard/*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        {{-- <!-- Category -->
        @can('user')
            <li class="menu-item {{ Request::is('category') || Request::is('category/*') ? 'active' : '' }}">
                <a href="{{ route('category.list') }}"  class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-category-alt"></i>
                    <div> Category </div>
                </a>
            </li>
        @endcan --}}



      




        <!-- User -->
         @can('user')
            <li class="menu-item {{ Request::is('user') || Request::is('user/*') ? 'active' : '' }}">
                <a href="{{ route('user.list') }}" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="User"> User </div>
                </a>
            </li>
        @endcan


              <!-- Settings -->
        @can('user-permission')
            <li
                class="menu-item {{ Request::is('settings') || Request::is('settings/*') ? 'active' : '' }} {{ Request::segment(1) == 'settings' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx bx-cog"></i>
                    <div data-i18n="Dashboards">Settings</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Request::segment(2) == 'user-permission' ? 'active' : '' }} ">
                        <a href="{{ route('user-permission') }}" class="menu-link">
                            <i class="menu-icon tf-icons fas fa-user-lock fa-fw"></i>
                            <div> User Permission</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div>Menu Permission</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div>Process Permission</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
        @endcan





    </ul>
</aside>

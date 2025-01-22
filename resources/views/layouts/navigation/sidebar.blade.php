<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="app-brand-link">
            <img src="{{ asset('images/SSD_white_logo.jpg') }}" alt="" width="100%">
        </a>
{{--        <a href="" class="navbar-brand">--}}
{{--            <h2 class="m-0 text-primary">Charity</h2>--}}
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

        <!-- Category -->
        @can('user')
            <li class="menu-item {{ Request::is('category') || Request::is('category/*') ? 'active' : '' }}">
                <a href="{{ route('category.list') }}"  class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-category-alt"></i>
                    <div> Category </div>
                </a>
            </li>
        @endcan


        <!-- Committee -->
        @can('user')
            <li class="menu-item {{ Request::is('committee') || Request::is('committee/*') ? 'active' : '' }}">
                <a href="{{ route('committee.list') }}" class="menu-link ">
                    <i class="menu-icon tf-icons bx bxs-user-account"></i>
                    <div> Committee </div>
                </a>
            </li>
        @endcan


        <!-- Event -->
        @can('user')
            <li class="menu-item {{ Request::is('event') || Request::is('event/*') ? 'active' : '' }}">
                <a href="{{ route('event.list') }}"  class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                    <div data-i18n="Event"> Event </div>
                </a>
            </li>
        @endcan


        <!-- User -->
        @can('user')
        <li class="menu-item {{ Request::is('users') || Request::is('users/*') ? 'active' : '' }} {{ Request::segment(1)== 'users' ? 'open' : '' }}">
            <a href="javascript:void(0);"  class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="User"> Users </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::segment(2)== 'user' ? 'active' : '' }}">
                    <a href="{{ route('user.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons fas fa-user fa-fw"></i>
                        <div> Admin User </div>
                    </a>
                </li>

                <li class="menu-item {{ Request::segment(2)== 'instructor' ? 'active' : '' }}">
                    <a href="{{ route('instructor.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons fas fa-user fa-fw"></i>
                        <div> Instructor </div>
                    </a>
                </li>
                <li class="menu-item {{ Request::segment(2)== 'student' ? 'active' : '' }}">
                    <a href="{{ route('student.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons fas fa-user fa-fw"></i>
                        <div> Student </div>
                    </a>
                </li>

            </ul>
        </li>
        @endcan


        <!-- Settings -->
        @can('user_permission')
        <li class="menu-item {{ Request::is('settings') || Request::is('settings/*') ? 'active' : '' }} {{ Request::segment(1)== 'settings' ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Dashboards">Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::segment(2)== 'user_permission' ? 'active' : '' }}">
                    <a href="{{ route('user_permission') }}" class="menu-link">
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

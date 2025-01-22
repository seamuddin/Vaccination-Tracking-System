
<nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
{{--    <a href="index.html" class="navbar-brand ms-4 ms-lg-0">--}}
{{--        <h1 class="fw-bold text-primary m-0">Chari<span class="text-white">Team</span></h1>--}}
{{--    </a>--}}
    <a href="javascript:void(0);" class="app-brand-link">
        <img src="{{ asset('images/SSD_white_logo.png') }}" alt="" width="250px">
    </a>
{{--    <a href="" class="navbar-brand">--}}
{{--        <h2 class="m-0 text-primary">Charity</h2>--}}
{{--    </a>--}}
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}">About</a>
            <a href="{{ route('event_page') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'event_page' ? 'active' : '' }}">Event</a>

            <!-- Committee Dropdown Start -->
            <div class="nav-item dropdown {{ Route::currentRouteName() == 'committee_by_type' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Committee</a>
                <div class="dropdown-menu m-0">
                    @foreach($committeeTypes as $committeeType)
                        <a href="{{ route('committee_by_type', $committeeType->id) }}" class="dropdown-item {{ Route::currentRouteName() == 'committee_by_type' && request()->route('committee_type_id') == $committeeType->id ? 'active' : '' }}">
                            {{ $committeeType->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <!-- Committee Dropdown End -->




{{--            <div class="nav-item dropdown">--}}
{{--                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>--}}
{{--                <div class="dropdown-menu m-0">--}}
{{--                    <a href="service.html" class="dropdown-item">Service</a>--}}
{{--                    <a href="donate.html" class="dropdown-item">Donate</a>--}}
{{--                    <a href="team.html" class="dropdown-item">Our Team</a>--}}
{{--                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>--}}
{{--                    <a href="404.html" class="dropdown-item">404 Page</a>--}}
{{--                </div>--}}
{{--            </div>--}}

            <a href="#contact" class="nav-item nav-link {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact</a>
        </div>
        <div class="d-none d-lg-flex ms-2">
            <a class="btn btn-outline-primary py-2 px-3" href="{{ route('login') }}">
                Login Now
                <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                    <i class="fa fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</nav>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>VaxTracker - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        @yield('styles')
        @include('frontend.styles')
        <link rel="stylesheet" href="{{ asset('assets/css/child_page.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/parent-dashboard-common.css') }}">
            <!-- Page CSS -->

            <!-- Helpers -->
            <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
            <script src="{{ asset('assets/js/config.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

            <script src="{{ asset('plugins/toastr/toastr.min.js')  }}"></script>

    </head>
    <body>
        @include('parent-dashboard.partials.navbar')

        @yield('content')
        
        @include('parent-dashboard.partials.footer')


        @yield('scripts')
        <!-- @include('frontend.scripts') -->

        <script>
                function toggleDropdown(event) {
                    if (event) event.stopPropagation();
                    var menu = document.getElementById('dropdownMenu');
                    var isOpen = menu.style.display === 'block';
                    if (!isOpen) {
                        menu.style.display = 'block';
                        document.addEventListener('click', closeDropdownOnClickOutside);
                    } else {
                        menu.style.display = 'none';
                        document.removeEventListener('click', closeDropdownOnClickOutside);
                    }
                }

                function closeDropdownOnClickOutside(e) {
                    var menu = document.getElementById('dropdownMenu');
                    var button = document.getElementById('userDropdown');
                    if (menu && button && !button.contains(e.target) && !menu.contains(e.target)) {
                        menu.style.display = 'none';
                        document.removeEventListener('click', closeDropdownOnClickOutside);
                    }
                }
        </script>
    </body>
</html>

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
    </head>
    <body>
        @include('parent-dashboard.partials.navbar')

        @yield('content')
        
        @include('parent-dashboard.partials.footer')

        @yield('scripts')
        @include('frontend.scripts')
        <script>
            function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const overlay = document.getElementById('dropdownOverlay');
            const avatar = dropdown.querySelector('.user-avatar');
            
            const isActive = dropdown.classList.contains('active');
            
            if (isActive) {
                closeDropdown();
            } else {
                openDropdown();
            }
        }

        function openDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const avatar = dropdown.querySelector('.user-avatar');
            
            dropdown.classList.add('active');
            avatar.classList.add('active');
            
            // Add click event listener to close dropdown when clicking outside
            // document.addEventListener('click', handleOutsideClick);
        }

        function closeDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const avatar = dropdown.querySelector('.user-avatar');
            
            dropdown.classList.remove('active');
            avatar.classList.remove('active');
            
            // Remove click event listener
            // document.removeEventListener('click', handleOutsideClick);
        }
        </script>
    </body>
</html>

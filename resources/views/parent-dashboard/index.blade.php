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
    </body>
</html>

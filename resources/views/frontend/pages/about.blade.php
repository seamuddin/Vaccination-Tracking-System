@extends('frontend.index')
@section('title')
    About
@endsection
@section('styles')

@endsection

@section('content')

    @include('frontend.partials.spinner')
    @include('frontend.partials.navbar')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    @include('frontend.partials.about')
    @include('frontend.partials.services')
    @include('frontend.partials.team')
    @include('frontend.partials.footer')

@endsection

@section('scripts')
@endsection

@extends('frontend.index')
@section('title')
    Home
@endsection
@section('styles')
<style>
    :root {
        --primary-color: #4F46E5;
        --secondary-color: #7C3AED;
        --accent-color: #818CF8;
        --background-light: #F5F3FF;
        --text-primary: #1F2937;
        --text-secondary: #4B5563;
    }

    body {
        font-family: system-ui, -apple-system, sans-serif;
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Modern gradient background for hero */
    .hero-section {
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        color: white;
        position: relative;
        overflow: hidden;
        padding: 6rem 0;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .search-box {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .search-box input {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        padding: 1rem 1.5rem;
    }

    .navbar {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
    }

    .service-card {
        border-radius: 1.5rem;
        border: none;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .service-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin: 0 auto 1.5rem;
        font-size: 1.5rem;
        transform: rotate(10deg);
        transition: transform 0.3s ease;
    }

    .service-card:hover .service-icon {
        transform: rotate(0deg);
    }

    .stats-section {
        background-color: var(--background-light);
        position: relative;
        overflow: hidden;
    }

    .stats-card {
        background: white;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .schedule-timeline {
        position: relative;
        padding: 2rem;
    }

    .timeline-card {
        border-radius: 1.5rem;
        border: none;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .timeline-card:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .emergency-card {
        border-radius: 1.5rem;
        border: none;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }

    .emergency-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 6px;
        background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-outline-primary {
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 0.8rem 2rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
    }

    /* Modern Footer */
    .footer {
        background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
        color: white;
        padding: 4rem 0;
    }

    /* Animation classes */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Floating animation for stats */
    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
</style>
@endsection

@section('content')

@include('frontend.partials.home.navbar')
@include('frontend.partials.home.content')
@include('frontend.partials.home.footer')


@endsection



@section('scripts')
@endsection

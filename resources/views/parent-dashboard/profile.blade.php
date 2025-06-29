@extends('parent-dashboard.index')
@section('title')
    Parent Dashboard - VaxTracker
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child-registration.css') }}">
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    

    <!-- Main Dashboard -->
    <div class="main-container">
        
        <div class="profile-container">
            <h2 class="profile-title">Parent Profile</h2>
            <div class="profile-card">
                <div class="profile-details">
                    <table>
                        <tr>
                            <th>Name</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ Auth::user()->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ Auth::user()->address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Registered At</th>
                            <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <style>
            .profile-container {
                max-width: 500px;
                margin: 30px auto;
                background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
                border-radius: 18px;
                box-shadow: 0 4px 24px rgba(0,0,0,0.07);
                padding: 32px 24px;
                transition: box-shadow 0.2s;
            }
            .profile-container:hover {
                box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            }
            .profile-title {
                text-align: center;
                font-size: 2rem;
                font-weight: 700;
                color: #374151;
                margin-bottom: 28px;
                letter-spacing: 1px;
            }
            .profile-card {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .profile-details table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0 12px;
            }
            .profile-details th,
            .profile-details td {
                padding: 10px 12px;
                font-size: 1rem;
            }
            .profile-details th {
                text-align: left;
                color: #6366f1;
                font-weight: 600;
                background: transparent;
                width: 140px;
                border-radius: 8px 0 0 8px;
            }
            .profile-details td {
                color: #334155;
                background: #f1f5f9;
                border-radius: 0 8px 8px 0;
                font-weight: 500;
            }
            @media (max-width: 600px) {
                .profile-container {
                    padding: 18px 6px;
                    max-width: 98vw;
                }
                .profile-title {
                    font-size: 1.3rem;
                }
                .profile-details th,
                .profile-details td {
                    font-size: 0.95rem;
                    padding: 8px 6px;
                }
                .profile-details th {
                    width: 90px;
                }
            }
        </style>

    </div>


@endsection

@section('scripts')
   
@endsection
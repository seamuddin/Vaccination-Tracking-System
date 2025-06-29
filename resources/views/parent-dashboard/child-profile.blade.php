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
        
        <div class="child-profile-container">
            <h2 class="child-profile-title">Child Profile</h2>
            <div class="child-profile-card">
            <div class="child-avatar">
                <img src="{{ asset('assets/images/child-avatar.png') }}" alt="Child Avatar" />
            </div>
            <div class="child-profile-details">
                <table>
                <tr>
                    <th>Name</th>
                    <td>{{ $child->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ isset($child->dob) ? \Carbon\Carbon::parse($child->dob)->format('d M Y') : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ ucfirst($child->gender ?? 'N/A') }}</td>
                </tr>
                <tr>
                    <th>Blood Group</th>
                    <td>{{ $child->blood_group ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Registered At</th>
                    <td>{{ isset($child->created_at) ? $child->created_at->format('d M Y') : 'N/A' }}</td>
                </tr>
                </table>
            </div>
            </div>
        </div>
        <style>
            .child-profile-container {
            max-width: 540px;
            margin: 36px auto;
            background: linear-gradient(135deg, #6366f1 0%, #a5b4fc 100%);
            border-radius: 20px;
            box-shadow: 0 6px 28px rgba(99,102,241,0.13);
            padding: 36px 26px 30px 26px;
            transition: box-shadow 0.2s;
            }
            .child-profile-container:hover {
            box-shadow: 0 12px 40px rgba(99,102,241,0.18);
            }
            .child-profile-title {
            text-align: center;
            font-size: 2.1rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 30px;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 8px rgba(99,102,241,0.12);
            }
            .child-profile-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(99,102,241,0.07);
            padding: 28px 18px 18px 18px;
            }
            .child-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, #818cf8 0%, #c7d2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(99,102,241,0.10);
            }
            .child-avatar img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #6366f1;
            background: #fff;
            }
            .child-profile-details table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 14px;
            }
            .child-profile-details th,
            .child-profile-details td {
            padding: 12px 14px;
            font-size: 1.08rem;
            }
            .child-profile-details th {
            text-align: left;
            color: #6366f1;
            font-weight: 700;
            background: transparent;
            width: 150px;
            border-radius: 8px 0 0 8px;
            }
            .child-profile-details td {
            color: #334155;
            background: #f1f5f9;
            border-radius: 0 8px 8px 0;
            font-weight: 500;
            }
            @media (max-width: 600px) {
            .child-profile-container {
                padding: 16px 4px 12px 4px;
                max-width: 99vw;
            }
            .child-profile-title {
                font-size: 1.2rem;
            }
            .child-profile-details th,
            .child-profile-details td {
                font-size: 0.97rem;
                padding: 8px 6px;
            }
            .child-profile-details th {
                width: 90px;
            }
            .child-avatar {
                width: 60px;
                height: 60px;
            }
            .child-avatar img {
                width: 45px;
                height: 45px;
            }
            }
        </style>

    </div>


@endsection

@section('scripts')
   
@endsection
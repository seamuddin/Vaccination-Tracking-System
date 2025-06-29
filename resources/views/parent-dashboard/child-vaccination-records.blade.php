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
        
        <div class="container">
            <h2 class="text-center mb-4" style="font-weight:700; color:#2d7dd2;">Vaccination Report</h2>
            <div class="table-responsive shadow rounded" style="background: #fff;">
            <table class="table table-hover align-middle mb-0" style="border-radius: 10px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg, #2d7dd2 0%, #97c1f0 100%); color: #fff;">
                <tr>
                    <th scope="col" id="vaccine-name-header">Vaccine Name</th>
                    <th scope="col" id="total-doses-header">Total Doses</th>
                    <th scope="col" id="doses-given-header">Doses Given</th>
                    <th scope="col" id="completion-header">% Completion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($report as $row)
                    <tr>
                    <td headers="vaccine-name-header" style="font-weight:500;">{{ $row->vaccine_name }}</td>
                    <td headers="total-doses-header">{{ $row->total_doses }}</td>
                    <td headers="doses-given-header">
                        <span class="badge bg-success" style="font-size:1em;">
                        {{ $row->given_doses }}
                        </span>
                    </td>
                    <td headers="completion-header">
                        <div class="progress" style="height: 20px; background: #e9ecef;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $row->completion_percentage }}%; background: #2d7dd2;" aria-valuenow="{{ $row->completion_percentage }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $row->completion_percentage }}%
                        </div>
                        </div>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>

    </div>


@endsection

@section('scripts')
   
@endsection
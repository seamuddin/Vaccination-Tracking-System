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
        <div class="dashboard-header">
            <h2>Vaccination Schedule</h2>
            <p>View your child's upcoming and past vaccinations.</p>
        </div>

        <div class="schedule-filter">
            <form method="GET" action="{{ route('parent.schedule') }}">
                <label for="child_id">Select Child:</label>
                <select name="child_id" id="child_id" class="form-control select2">
                    <option value="">All Children</option>
                    @foreach($children as $child)
                        <option value="{{ $child->id }}" {{ request('child_id') == $child->id ? 'selected' : '' }}>
                            {{ $child->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <div class="schedule-table-container">
            <table class="table table-bordered schedule-table">
                <thead>
                    <tr>
                        <th>Child Name</th>
                        <th>Vaccine</th>
                        <th>Date Scheduled</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->child->name }}</td>
                            <td>{{ $schedule->vaccine->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->scheduled_date)->format('d M Y') }}</td>
                            <td>
                                @if($schedule->status == 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif($schedule->scheduled_date < now())
                                    <span class="badge badge-danger">Missed</span>
                                @else
                                    <span class="badge badge-warning">Upcoming</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No vaccination schedules found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


@endsection

@section('scripts')
   
@endsection
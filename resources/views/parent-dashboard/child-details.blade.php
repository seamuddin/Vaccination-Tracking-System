@extends('parent-dashboard.index')
@section('title')
    Parent Dashboard - VaxTracker
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child_page.css') }}">
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    

    <!-- Main Dashboard -->
    <div class="main-container">
        
        <!-- Main Container -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <div class="page-icon">
                    <i class="fas fa-child"></i>
                </div>
                <div>
                    <h1>My Children</h1>
                    <p>Manage and track vaccination records for your children</p>
                </div>
            </div>
            <button class="btn btn-primary" onclick="openAddChildModal()">
                <i class="fas fa-plus"></i>
                Add New Child
            </button>
        </div>

        <!-- Stats Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">2</div>
                <div class="stat-label">Total Children</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon up-to-date">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">1</div>
                <div class="stat-label">Up to Date</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value">1</div>
                <div class="stat-label">Pending Vaccines</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon overdue">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value">0</div>
                <div class="stat-label">Overdue</div>
            </div>
        </div>

        <!-- Children Section -->
        <div class="children-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-list"></i>
                    Registered Children
                </h2>
                <div style="display: flex; gap: 1rem;">
                    <button class="btn btn-outline btn-sm" onclick="exportRecords()">
                        <i class="fas fa-download"></i>
                        Export Records
                    </button>
                    <button class="btn btn-secondary btn-sm" onclick="printRecords()">
                        <i class="fas fa-print"></i>
                        Print
                    </button>
                </div>
            </div>

            <div class="children-grid">
                <!-- Child 1 -->
                <div class="child-card" onclick="viewChildDetails('child1')">
                    <div class="child-header">
                        <div class="child-avatar">AR</div>
                        <div class="child-info">
                            <h3 class="child-name">Aisha Rahman</h3>
                            <div class="child-details">
                                <div class="child-detail-item">
                                    <i class="fas fa-birthday-cake"></i>
                                    <span>Born: March 15, 2020 (4 years old)</span>
                                </div>
                                <div class="child-detail-item">
                                    <i class="fas fa-venus"></i>
                                    <span>Gender: Female</span>
                                </div>
                                <div class="child-detail-item">
                                    <i class="fas fa-id-card"></i>
                                    <span>Birth Registration: 20200315001</span>
                                </div>
                            </div>
                            <div class="child-actions">
                                <button class="btn btn-outline btn-sm" onclick="event.stopPropagation(); viewVaccineSchedule('child1')">
                                    <i class="fas fa-calendar"></i>
                                    Schedule
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="event.stopPropagation(); bookAppointment('child1')">
                                    <i class="fas fa-plus"></i>
                                    Book Vaccine
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="vaccination-progress">
                        <div class="progress-header">
                            <span class="progress-title">Vaccination Progress</span>
                            <span class="progress-stats">15/15 completed</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 100%;"></div>
                        </div>
                    </div>

                    <div class="vaccination-status">
                        <div class="status-badge status-up-to-date">
                            <i class="fas fa-check-circle"></i>
                            Up to Date
                        </div>
                        <div class="next-vaccine">
                            <div class="next-vaccine-title">Next Vaccine:</div>
                            <div class="next-vaccine-date">All vaccines completed</div>
                        </div>
                    </div>

                    <div class="recent-vaccines">
                        <div class="recent-vaccines-title">
                            <i class="fas fa-history"></i>
                            Recent Vaccines
                        </div>
                        <div class="vaccine-item">
                            <span class="vaccine-name">DPT Booster</span>
                            <span class="vaccine-date">Dec 15, 2023</span>
                        </div>
                        <div class="vaccine-item">
                            <span class="vaccine-name">MMR-2</span>
                            <span class="vaccine-date">Oct 20, 2023</span>
                        </div>
                    </div>
                </div>

                <!-- Child 2 -->
                <div class="child-card pending" onclick="viewChildDetails('child2')">
                    <div class="child-header">
                        <div class="child-avatar">HR</div>
                        <div class="child-info">
                            <h3 class="child-name">Hassan Rahman</h3>
                            <div class="child-details">
                                <div class="child-detail-item">
                                    <i class="fas fa-birthday-cake"></i>
                                    <span>Born: August 10, 2022 (2 years old)</span>
                                </div>
                                <div class="child-detail-item">
                                    <i class="fas fa-mars"></i>
                                    <span>Gender: Male</span>
                                </div>
                                <div class="child-detail-item">
                                    <i class="fas fa-id-card"></i>
                                    <span>Birth Registration: 20220810002</span>
                                </div>
                            </div>
                            <div class="child-actions">
                                <button class="btn btn-outline btn-sm" onclick="event.stopPropagation(); viewVaccineSchedule('child2')">
                                    <i class="fas fa-calendar"></i>
                                    Schedule
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="event.stopPropagation(); bookAppointment('child2')">
                                    <i class="fas fa-plus"></i>
                                    Book Vaccine
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="vaccination-progress">
                        <div class="progress-header">
                            <span class="progress-title">Vaccination Progress</span>
                            <span class="progress-stats">8/10 completed</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill pending" style="width: 80%;"></div>
                        </div>
                    </div>

                    <div class="vaccination-status">
                        <div class="status-badge status-pending">
                            <i class="fas fa-clock"></i>
                            Pending Vaccines
                        </div>
                        <div class="next-vaccine">
                            <div class="next-vaccine-title">Next Vaccine:</div>
                            <div class="next-vaccine-date">MMR-1 (Due: Jan 15, 2025)</div>
                        </div>
                    </div>

                    <div class="recent-vaccines">
                        <div class="recent-vaccines-title">
                            <i class="fas fa-history"></i>
                            Recent Vaccines
                        </div>
                        <div class="vaccine-item">
                            <span class="vaccine-name">DPT-3</span>
                            <span class="vaccine-date">Nov 10, 2024</span>
                        </div>
                        <div class="vaccine-item">
                            <span class="vaccine-name">IPV-3</span>
                            <span class="vaccine-date">Nov 10, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


@endsection

@section('scripts')
   
@endsection
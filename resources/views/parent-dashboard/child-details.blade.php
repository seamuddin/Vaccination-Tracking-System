@extends('parent-dashboard.main')
@section('header-resources')

    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child_page.css') }}">
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>


@endsection

@section('body')

 <!-- Main Dashboard -->
    <div class="main-container mt-4">
        
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
            <a href="{{ route('child.register.form') }}" class="btn btn-primary" onclick="openAddChildModal()">
                <i class="fas fa-plus"></i>
                Regester New Child
             </a>
        </div>

       

        <!-- Children Section -->
        <div class="children-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-list"></i>
                    Registered Children
                </h2>
                
            </div>

            <div class="children-grid">
                <!-- Child 1 -->
                @foreach($children as $child)
                    <div class="child-card {{ ($child->dose_summary['given_count'] ?? 0) == ($child->dose_summary['total_count'] ?? 0) ? '' : 'pending' }}" onclick="">
                        <div class="child-header">
                            <div class="child-avatar">
                                {{ strtoupper(substr($child->name,0,1)) }}
                            </div>
                            <div class="child-info">
                                <h3 class="child-name">{{ $child->name }}</h3>
                                <div class="child-details">
                                    <div class="child-detail-item">
                                        <i class="fas fa-birthday-cake"></i>
                                        <span>
                                            Born: {{ \Carbon\Carbon::parse($child->date_of_birth)->format('F d, Y') }} 
                                            ({{ \Carbon\Carbon::parse($child->date_of_birth)->age }} years old)
                                        </span>
                                    </div>
                                    <div class="child-detail-item">
                                        <i class="fas fa-{{ strtolower($child->gender) == 'male' ? 'mars' : 'venus' }}"></i>
                                        <span>Gender: {{ ucfirst($child->gender) }}</span>
                                    </div>
                                    <div class="child-detail-item">
                                        <i class="fas fa-id-card"></i>
                                        <span>Birth Registration: {{ $child->birth_certificate_no }}</span>
                                    </div>
                                    <div class="child-detail-item">
                                        <i class="fa-solid fa-id-card-clip"></i>
                                        <span>ID: {{ $child->card_no }}</span>
                                    </div>
                                    <div class="child-detail-item">
                                        <i class="fas fa-file-alt"></i>
                                        <span>
                                            Birth Certificate:
                                            @if(!empty($child->birth_certificate) && file_exists(public_path($child->birth_certificate)))
                                                <a href="{{ asset($child->birth_certificate) }}" target="_blank">View File</a>
                                            @else
                                                Not uploaded or file not found
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="child-actions">
                                    <button class="btn btn-outline btn-sm" onclick="event.stopPropagation(); viewVaccineSchedule('{{ $child->id }}')">
                                        <i class="fas fa-calendar"></i>
                                        Schedule
                                    </button>
                                    <button class="btn btn-primary btn-sm" onclick="event.stopPropagation(); bookAppointment('{{ $child->id }}')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Update 
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="vaccination-progress">
                            <div class="progress-header">
                                <span class="progress-title">Vaccination Progress</span>
                                <span class="progress-stats">
                                    {{ $child->dose_summary['given_count'] ?? 0 }}/{{ $child->dose_summary['total_count'] ?? 0 }} completed
                                </span>
                            </div>
                            <div class="progress-bar">
                                <div 
                                    class="progress-fill {{ ($child->dose_summary['given_count'] ?? 0) < ($child->dose_summary['total_count'] ?? 0) ? 'pending' : 'completed' }}" 
                                    style="width: {{ ($child->dose_summary['total_count'] ?? 0) > 0 ? round(($child->dose_summary['given_count'] ?? 1)/($child->dose_summary['total_count'] ?? 1)*100) : 0 }}%;">
                                </div>
                            </div>
                        </div>

                        <div class="vaccination-status">
                            <div class="next-vaccine">
                                <div class="next-vaccine-title">Next Vaccine:</div>
                                <div class="next-vaccine-date">
                                    @if(isset($child->next_vaccine) && $child->next_vaccine)
                                        {{ $child->next_vaccine['vaccine_name'] }}- Dose {{ $child->next_vaccine['dose_number'] }} 
                                        (Due: {{ \Carbon\Carbon::parse($child->next_vaccine['next_due_date'])->format('M d, Y') }})
                                    @else
                                        All vaccines completed
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="recent-vaccines">
                            <div class="recent-vaccines-title">
                                <i class="fas fa-history"></i>
                                Recent Vaccines
                            </div>
                            @if(isset($child->recent_given_vaccines) && count($child->recent_given_vaccines))
                                @foreach($child->recent_given_vaccines as $vaccine)
                                    <div class="vaccine-item">
                                        <span class="vaccine-name">{{ $vaccine['vaccine_name'] }} - Dose {{ $vaccine['dose_number'] }}</span>
                                        <span class="vaccine-date">{{ \Carbon\Carbon::parse($vaccine['date_given'])->format('M d, Y') }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="vaccine-item">
                                    <span>No recent vaccines</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Child 2 -->
                <!-- <div class="child-card pending" onclick="viewChildDetails('child2')">
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
                </div> -->
            </div>
        </div>
    </div>

    </div>

@endsection


@section('footer-script')

@endsection


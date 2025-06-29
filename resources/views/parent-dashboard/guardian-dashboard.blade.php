@extends('parent-dashboard.index')
@section('title')
    Parent Dashboard - VaxTracker
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
@endsection

@section('content')
    

    <!-- Main Dashboard -->
    <main class="dashboard-container">
        <div class="container">
            
            <!-- Welcome Message -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="welcome-title">Welcome, {{ $user->name }}</h1>
                        <p class="welcome-subtitle">Keep your children healthy and protected with up-to-date vaccinations</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            Today: <strong>{{ \Carbon\Carbon::now()->format('F d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Child Overview Cards -->
            <div class="children-overview">
                <h2 class="section-title">
                    <i class="fas fa-child"></i>
                    My Children
                </h2>
                
                @foreach($children as $child)
                    <div class="child-overview-card">
                        <div class="child-header">
                            <div class="child-info">
                                <div class="child-avatar">
                                    <i class="fas fa-child"></i>
                                </div>
                                <div class="child-details">
                                    <h3>{{ $child->name }}</h3>
                                    <div class="child-age">
                                        {{ \Carbon\Carbon::parse($child->birthdate)->age }} years{{ \Carbon\Carbon::parse($child->birthdate)->diffInMonths(now()) % 12 > 0 ? ', ' . (\Carbon\Carbon::parse($child->birthdate)->diffInMonths(now()) % 12) . ' months' : '' }} old • Born: {{ \Carbon\Carbon::parse($child->birthdate)->format('F d, Y') }}
                                    </div>
                                    <div class="vaccination-summary">
                                        <span class="summary-text">Vaccination Progress:</span>
                                        <span class="summary-fraction">{{ $child->dose_summary['given_count'] }} / {{ $child->dose_summary['total_count'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="child-actions">
                                <a href="{{ route('child.vaccination.records', ['id' => $child->id]) }}" class="btn-view-profile">
                                    <i class="fas fa-eye me-1"></i>Vaccination Record
                                </a>
                                <a href="#" class="btn-download" onclick="downloadCertificate({{ $child->id }})">
                                    <i class="fas fa-download me-1"></i>Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Vaccination Progress Tracker -->
            
            <!-- Upcoming Vaccines Section -->
            <div class="upcoming-vaccines">
                <h2 class="section-title">
                    <i class="fas fa-calendar-check"></i>
                    Upcoming Vaccines (Next 30 Days)
                </h2>
                @forelse($upcomingVaccines as $vaccine)
                    <div class="vaccine-item {{ $vaccine->status }}">
                        <div class="vaccine-icon {{ $vaccine->status }}">
                            @if($vaccine->status === 'scheduled')
                                <i class="fas fa-exclamation-triangle"></i>
                            @elseif($vaccine->status === 'missed')
                                <i class="fas fa-exclamation"></i>
                            @else
                                <i class="fas fa-syringe"></i>
                            @endif
                        </div>
                        <div class="vaccine-details">
                            <div class="vaccine-name">{{ $vaccine->vaccine->name }} - Dose {{ $vaccine->dose_number }} - {{ $vaccine->child->name }}</div>
                            <div class="vaccine-info">
                                <span>
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $vaccine->status === 'scheduled' ? 'Scheduled:' : ($vaccine->status === 'missed' || $vaccine->status === 'due-soon' ? 'Due:' : 'Recommended:') }}
                                    {{ \Carbon\Carbon::parse($vaccine->date)->format('F d, Y') }}
                                </span>
                                @if($vaccine->status === 'overdue')
                                    <span>
                                        <i class="fas fa-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($vaccine->date)->diffForHumans(null, null, false, 2) }} overdue
                                    </span>
                                @elseif($vaccine->status === 'due-soon')
                                    <span>
                                        <i class="fas fa-clock me-1"></i>
                                        Due in {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($vaccine->date), false) }} days
                                    </span>
                                @elseif($vaccine->status === 'scheduled' && !empty($vaccine->location))
                                    <span>
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $vaccine->location }}
                                    </span>
                                @elseif($vaccine->status === 'seasonal')
                                    <span>
                                        <i class="fas fa-info-circle me-1"></i>
                                        Seasonal protection
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="vaccine-status status-{{ $vaccine->status }}">
                            {{ strtoupper($vaccine->label ?? $vaccine->status) }}
                        </div>
                        <!-- <div class="vaccine-actions">
                            <button class="btn-vaccine-action btn-mark-given" onclick="markAsGiven('{{ $vaccine->id }}', '{{ strtolower($vaccine->child_name) }}')">
                                <i class="fas fa-check me-1"></i>Mark as Given
                            </button>
                            <button class="btn-vaccine-action btn-remind" onclick="setReminder('{{ $vaccine->id }}', '{{ strtolower($vaccine->child_name) }}')">
                                <i class="fas fa-bell me-1"></i>Remind Me
                            </button>
                        </div> -->
                    </div>
                @empty
                    <div class="text-muted">No upcoming vaccines in the next 30 days.</div>
                @endforelse
            </div>

            <!-- Alerts & Notifications Panel -->
            <!-- <div class="alerts-panel">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Alerts & Notifications
                </h2>
                
                <div class="alert-item alert-critical">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span class="red-badge">!</span>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">OVERDUE: Emma's DTaP Booster</div>
                        <div class="alert-message">DTaP (5th dose) was due on March 12, 2024. Please schedule an appointment immediately to keep Emma protected.</div>
                    </div>
                    <div class="alert-time">3 days ago</div>
                </div>

                <div class="alert-item alert-warning">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Upcoming: Emma's MMR 2nd Dose</div>
                        <div class="alert-message">MMR (2nd dose) is due on March 20, 2024. Schedule an appointment to stay on track.</div>
                    </div>
                    <div class="alert-time">Today</div>
                </div>

                <div class="alert-item alert-info">
                    <div class="alert-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Flu Season Reminder</div>
                        <div class="alert-message">Annual flu vaccines are now available for the 2024-2025 season. Protect your family this fall and winter.</div>
                    </div>
                    <div class="alert-time">2 days ago</div>
                </div>

                <div class="alert-item alert-info">
                    <div class="alert-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Vaccination Record Updated</div>
                        <div class="alert-message">Liam's 6-month vaccines have been successfully recorded. Next vaccines due at 9 months.</div>
                    </div>
                    <div class="alert-time">1 week ago</div>
                </div>
            </div> -->
        </div>
    </main>

   
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Dashboard functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dashboard
            initializeDashboard();
            
            // Animate timeline progress
            animateTimelineProgress();
            
            // Setup notification system
            setupNotifications();
        });

        function initializeDashboard() {
            // Calculate ages dynamically
            updateChildAges();
            
            // Check for overdue vaccines
            checkOverdueVaccines();
            
            // Load recent activities
            loadRecentActivities();
        }

        function updateChildAges() {
            // This would calculate actual ages from birth dates
            // For demo purposes, using static data
            console.log('Ages updated for all children');
        }

        function animateTimelineProgress() {
            setTimeout(() => {
                const progressBar = document.querySelector('.timeline-progress');
                if (progressBar) {
                    progressBar.style.width = '60%';
                }
            }, 500);
        }

        function markAsGiven(vaccineId, childName) {
            // Show confirmation dialog
            if (confirm(`Mark ${vaccineId} as given for ${childName}?`)) {
                // This would typically send to backend
                showNotification('success', `Vaccine marked as completed for ${childName}`);
                
                // Update UI
                updateVaccineStatus(vaccineId, childName, 'completed');
                
                // Refresh progress
                updateVaccinationProgress();
            }
        }

        function setReminder(vaccineId, childName) {
            // Show reminder options
            const reminderTime = prompt('Set reminder (days before due date):', '3');
            if (reminderTime) {
                showNotification('info', `Reminder set for ${reminderTime} days before ${vaccineId} for ${childName}`);
            }
        }

        function downloadCertificate(childId) {
            // Simulate PDF download
            showNotification('info', 'Generating vaccination certificate PDF...');
            
            setTimeout(() => {
                // In real app, this would download the actual PDF
                showNotification('success', 'Vaccination certificate downloaded successfully');
            }, 2000);
        }

        function updateVaccineStatus(vaccineId, childName, status) {
            // Update the vaccine item in the UI
            const vaccineItems = document.querySelectorAll('.vaccine-item');
            vaccineItems.forEach(item => {
                const nameElement = item.querySelector('.vaccine-name');
                if (nameElement && nameElement.textContent.includes(vaccineId) && nameElement.textContent.includes(childName)) {
                    // Update status
                    const statusElement = item.querySelector('.vaccine-status');
                    if (status === 'completed') {
                        statusElement.className = 'vaccine-status status-completed';
                        statusElement.textContent = 'COMPLETED';
                        statusElement.style.background = 'rgba(16, 185, 129, 0.1)';
                        statusElement.style.color = 'var(--success-color)';
                        
                        // Hide action buttons
                        const actions = item.querySelector('.vaccine-actions');
                        actions.style.display = 'none';
                        
                        // Add checkmark icon
                        const icon = item.querySelector('.vaccine-icon');
                        icon.innerHTML = '<i class="fas fa-check"></i>';
                        icon.style.background = 'var(--success-color)';
                    }
                }
            });
        }

        function updateVaccinationProgress() {
            // Update progress bars and statistics
            // This would recalculate based on new completions
            console.log('Updating vaccination progress...');
        }

        function showNotification(type, message) {
            // Create notification toast
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} position-fixed`;
            notification.style.cssText = `
                top: 100px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                border-radius: 10px;
            `;
            notification.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'info' ? 'info-circle' : 'exclamation-triangle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }

        function setupNotifications() {
            // Setup real-time notifications
            // This would typically use WebSockets or Server-Sent Events
            console.log('Notification system initialized');
        }

        function checkOverdueVaccines() {
            // Check for overdue vaccines and update UI
            const overdueCount = document.querySelectorAll('.vaccine-item.overdue').length;
            if (overdueCount > 0) {
                showNotification('warning', `You have ${overdueCount} overdue vaccination(s)`);
            }
        }

        function loadRecentActivities() {
            // Load recent vaccination activities
            console.log('Loading recent activities...');
        }

        // QR Code functionality
        function generateQRCode(childId) {
            // This would generate actual QR code for the child's vaccination record
            console.log(`Generating QR code for child ${childId}`);
        }

        // Responsive navigation
        function toggleMobileNav() {
            const nav = document.querySelector('.navbar-collapse');
            nav.classList.toggle('show');
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case '1':
                        e.preventDefault();
                        window.location.href = 'dashboard.html';
                        break;
                    case '2':
                        e.preventDefault();
                        window.location.href = 'register-child.html';
                        break;
                    case '3':
                        e.preventDefault();
                        window.location.href = 'schedule.html';
                        break;
                    case '4':
                        e.preventDefault();
                        window.location.href = 'notifications.html';
                        break;
                }
            }
        });

        // Auto-refresh data every 5 minutes
        setInterval(() => {
            loadRecentActivities();
            checkOverdueVaccines();
        }, 5 * 60 * 1000);

        // Service worker for offline functionality
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => console.log('SW registered'))
                .catch(error => console.log('SW registration failed'));
        }
    </script>
@endsection
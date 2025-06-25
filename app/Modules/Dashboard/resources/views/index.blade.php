@extends('layouts.admin')

@section('header-resources')
{{--  @include('partials.datatable-css')  --}}
@endsection

@section('content')
    {{--  @include('partials.messages') --}}

   {{-- @if (Auth::user()->is_approved != 1) --}} 
  {{-- @else --}}
        <div class="row">
            <div class="col-md-12">
                @include('Dashboard::dashboard')
            </div>
        </div>
   {{-- @endif --}}
@endsection

@section('footer-script')
   {{-- @yield('chart_script') --}}
    {{-- @include('partials.datatable-js') --}}

    <script>
        // Global variables
        let currentChild = null;
        let currentVaccine = null;

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardData();
            initializeTooltips();
            setCurrentDate();
        });

        // Administer vaccine functionality
        function administerVaccine(childId, vaccineId) {
            // Simulate loading child and vaccine data
            const childData = getChildData(childId);
            const vaccineData = getVaccineData(vaccineId);
            
            currentChild = childId;
            currentVaccine = vaccineId;
            
            // Populate modal
            document.getElementById('childName').value = childData.name;
            document.getElementById('vaccineName').value = vaccineData.name;
            document.getElementById('dateAdministered').value = new Date().toISOString().split('T')[0];
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('administerVaccineModal'));
            modal.show();
        }

        function confirmAdministration() {
            const form = document.getElementById('administerForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            const data = {
                childId: currentChild,
                vaccineId: currentVaccine,
                dateAdministered: document.getElementById('dateAdministered').value,
                lotNumber: document.getElementById('lotNumber').value,
                adminSite: document.getElementById('adminSite').value,
                notes: document.getElementById('adminNotes').value,
                healthWorkerId: getCurrentHealthWorkerId()
            };
            
            // Show loading
            const btn = event.target;
            btn.classList.add('loading');
            btn.innerHTML = '<span class="spinner"></span>Administering...';
            
            // Simulate API call
            setTimeout(() => {
                // Update vaccination record
                updateVaccinationRecord(data);
                
                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('administerVaccineModal')).hide();
                
                // Show success message
                showToast('success', `Vaccine administered successfully! Next dose automatically scheduled.`);
                
                // Refresh dashboard
                refreshDashboardData();
                
                // Reset button
                btn.classList.remove('loading');
                btn.innerHTML = '<i class="fas fa-syringe me-1"></i>Confirm Administration';
            }, 2000);
        }

        // Register new child
        function registerNewChild() {
            const modal = new bootstrap.Modal(document.getElementById('registerChildModal'));
            modal.show();
        }

        function confirmRegistration() {
            const form = document.getElementById('registerForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            const data = {
                firstName: document.getElementById('regFirstName').value,
                lastName: document.getElementById('regLastName').value,
                dateOfBirth: document.getElementById('regDOB').value,
                gender: document.getElementById('regGender').value,
                guardianName: document.getElementById('regGuardianName').value,
                guardianPhone: document.getElementById('regGuardianPhone').value,
                guardianEmail: document.getElementById('regGuardianEmail').value,
                address: document.getElementById('regAddress').value
            };
            
            // Show loading
            const btn = event.target;
            btn.classList.add('loading');
            btn.innerHTML = '<span class="spinner"></span>Registering...';
            
            // Simulate API call
            setTimeout(() => {
                // Register child and auto-generate vaccine schedule
                registerChildAndGenerateSchedule(data);
                
                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('registerChildModal')).hide();
                
                // Show success message
                showToast('success', `${data.firstName} registered successfully! Vaccination schedule auto-generated.`);
                
                // Refresh dashboard
                refreshDashboardData();
                
                // Reset form and button
                form.reset();
                btn.classList.remove('loading');
                btn.innerHTML = '<i class="fas fa-user-plus me-1"></i>Register Child';
            }, 2000);
        }

        // Quick actions
        function quickVaccination() {
            // Open quick vaccination modal or redirect
            window.location.href = 'quick-vaccination.html';
        }

        function viewReports() {
            window.location.href = 'reports.html';
        }

        function searchChild() {
            // Open search modal or redirect
            window.location.href = 'search-children.html';
        }

        function viewChild(childId) {
            window.location.href = `child-profile.html?id=${childId}`;
        }

        function postponeVaccine(childId, vaccineId) {
            if (confirm('Are you sure you want to postpone this vaccination?')) {
                // Update vaccine schedule
                updateVaccineSchedule(childId, vaccineId, 'postponed');
                showToast('success', 'Vaccination postponed successfully.');
                refreshDashboardData();
            }
        }

        // Bulk operations
        function bulkUpdateRecords() {
            window.location.href = 'bulk-update.html';
        }

        function generateReports() {
            window.location.href = 'batch-reports.html';
        }

        function sendReminders() {
            if (confirm('Send reminder notifications to all guardians with due vaccines?')) {
                // Simulate sending reminders
                showToast('success', 'Reminder notifications sent to 47 guardians.');
            }
        }

        // Utility functions
        function refreshVaccines() {
            showToast('success', 'Vaccine list refreshed.');
            refreshDashboardData();
        }

        function exportList() {
            // Simulate export
            showToast('success', 'Due vaccines list exported successfully.');
        }

        function bulkAction() {
            window.location.href = 'bulk-actions.html';
        }

        // Data simulation functions
        function getChildData(childId) {
            const children = {
                'emma': { name: 'Emma Johnson', age: '4 years', guardian: 'Sarah Johnson' },
                'liam': { name: 'Liam Johnson', age: '9 months', guardian: 'Sarah Johnson' },
                'alex': { name: 'Alex Smith', age: '2 years', guardian: 'Michael Smith' },
                'maya': { name: 'Maya Rodriguez', age: '6 months', guardian: 'Carlos Rodriguez' }
            };
            return children[childId] || { name: 'Unknown Child' };
        }

        function getVaccineData(vaccineId) {
            const vaccines = {
                'dtap5': { name: 'DTaP (5th dose)', type: 'Routine' },
                '9month': { name: '9-Month Vaccines', type: 'Routine' },
                'mmr1': { name: 'MMR (1st dose)', type: 'Routine' },
                '6month': { name: '6-Month Vaccines', type: 'Routine' }
            };
            return vaccines[vaccineId] || { name: 'Unknown Vaccine' };
        }

        function getCurrentHealthWorkerId() {
            return 'hw_001'; // Simulate current health worker ID
        }

        function updateVaccinationRecord(data) {
            // Simulate updating vaccination record
            console.log('Updating vaccination record:', data);
            
            // In real implementation, this would:
            // 1. Update Vaccination_Record with date_given
            // 2. Calculate next due date using dose_interval_days
            // 3. Update child's vaccination status
            // 4. Send notification to guardian
        }

        function registerChildAndGenerateSchedule(data) {
            // Simulate child registration and schedule generation
            console.log('Registering child and generating schedule:', data);
            
            // In real implementation, this would:
            // 1. Create child record
            // 2. Auto-generate all scheduled vaccines based on age
            // 3. Create vaccination schedule entries
            // 4. Send welcome notification to guardian
        }

        function updateVaccineSchedule(childId, vaccineId, action) {
            // Simulate schedule update
            console.log('Updating vaccine schedule:', { childId, vaccineId, action });
        }

        function loadDashboardData() {
            // Simulate loading dashboard data
            console.log('Loading dashboard data...');
        }

        function refreshDashboardData() {
            // Simulate refreshing dashboard
            console.log('Refreshing dashboard data...');
            
            // In real implementation, reload all counts and lists
            setTimeout(() => {
                showToast('success', 'Dashboard data updated.');
            }, 1000);
        }

        function initializeTooltips() {
            // Initialize Bootstrap tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        function setCurrentDate() {
            // Set current date for date inputs
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateAdministered').value = today;
        }

        // Toast notification system
        function showToast(type, message) {
            const toastId = type + 'Toast';
            const messageId = type + 'Message';
            
            document.getElementById(messageId).textContent = message;
            
            const toast = new bootstrap.Toast(document.getElementById(toastId), {
                autohide: true,
                delay: 4000
            });
            toast.show();
        }

        // Auto-refresh dashboard every 5 minutes
        setInterval(refreshDashboardData, 5 * 60 * 1000);

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'n':
                        e.preventDefault();
                        registerNewChild();
                        break;
                    case 'f':
                        e.preventDefault();
                        searchChild();
                        break;
                    case 'r':
                        e.preventDefault();
                        refreshDashboardData();
                        break;
                }
            }
        });
    </script>
@endsection

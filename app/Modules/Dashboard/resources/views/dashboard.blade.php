<!-- Main Dashboard -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Welcome Card -->
            <div class="col-lg-8 col-md-12 col-12 mb-4 order-0">
                <div class="card welcome-card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body welcome-content">
                                <h5 class="card-title text-white">Welcome back, {{ $user->name }}</h5>
                                <p class="mb-4 text-white-50">
                                    You have administered <span class="fw-bold text-white">28 vaccines</span> this week. 
                                    <span class="fw-bold text-white">12 children</span> are due for vaccinations today.
                                </p>
                                <a href="#due-vaccines" class="btn btn-outline-light">View Due Vaccines</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <i class="fas fa-user-md" style="font-size: 8rem; color: rgba(255,255,255,0.2);"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-lg-4 col-md-12 col-12 mb-4">
                <div class="card">
                            <div class="card-header">
                                <h6 class="m-0">Vaccination Progress</h6>
                            </div>
                            <div class="card-body pt-2">
                                <div class="progress-item">
                                    <div class="progress-header">
                                        <span class="progress-label">0-12 Months</span>
                                        <span class="progress-value">92%</span>
                                    </div>
                                    <div class="progress-bar-custom">
                                        <div class="progress-fill" style="width: 92%"></div>
                                    </div>
                                </div>
                                
                                <div class="progress-item">
                                    <div class="progress-header">
                                        <span class="progress-label">1-4 Years</span>
                                        <span class="progress-value">87%</span>
                                    </div>
                                    <div class="progress-bar-custom">
                                        <div class="progress-fill" style="width: 87%"></div>
                                    </div>
                                </div>
                                
                                <div class="progress-item">
                                    <div class="progress-header">
                                        <span class="progress-label">5-18 Years</span>
                                        <span class="progress-value">94%</span>
                                    </div>
                                    <div class="progress-bar-custom">
                                        <div class="progress-fill" style="width: 94%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
       
       
        <div class="row">
                    <div class="col-lg-3 col-md-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body stat-card " >
                                <div class="stat-icon success">
                                    <i class="fas fa-syringe"></i>
                                </div>
                                <div class="stat-number">156</div>
                                <div class="stat-label">Vaccines Given Today</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> +23.8%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body stat-card">
                                <div class="stat-icon warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="stat-number">24</div>
                                <div class="stat-label">Overdue Vaccines</div>
                                <div class="stat-change negative">
                                    <i class="fas fa-arrow-down"></i> -12.5%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Stats -->
                    <div class="col-lg-3 col-md-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body stat-card">
                                <div class="stat-icon primary">
                                    <i class="fas fa-child"></i>
                                </div>
                                <div class="stat-number">89</div>
                                <div class="stat-label">Children Seen</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> +15.3%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 mb-4">
                        <div class="card">
                            <div class="card-body stat-card">
                                <div class="stat-icon danger">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="stat-number">12</div>
                                <div class="stat-label">New Registrations</div>
                                <div class="stat-change positive">
                                    <i class="fas fa-arrow-up"></i> +8.1%
                                </div>
                            </div>
                        </div>
                    </div>


                    
        </div>

        <div class="row">
            <!-- Due Vaccines Today -->
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4" id="due-vaccines">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0 me-2">Due Vaccines Today</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#" onclick="refreshVaccines()">Refresh</a>
                                <a class="dropdown-item" href="#" onclick="exportList()">Export List</a>
                                <a class="dropdown-item" href="#" onclick="bulkAction()">Bulk Actions</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <!-- Overdue Vaccines -->
                        <div class="vaccine-item overdue">
                            <div class="vaccine-avatar">EM</div>
                            <div class="vaccine-details">
                                <div class="child-name">Emma Johnson (4 years)</div>
                                <div class="vaccine-info">
                                    <i class="fas fa-syringe me-1"></i>DTaP (5th dose) • 
                                    <i class="fas fa-calendar me-1"></i>Due: 3 days ago •
                                    <i class="fas fa-user me-1"></i>Guardian: Sarah Johnson
                                </div>
                            </div>
                            <div class="vaccine-status status-overdue">OVERDUE</div>
                            <div class="vaccine-actions">
                                <button class="btn-sm-custom btn-administer" onclick="administerVaccine('emma', 'dtap5')">
                                    <i class="fas fa-syringe me-1"></i>Administer
                                </button>
                                <button class="btn-sm-custom btn-view" onclick="viewChild('emma')">
                                    <i class="fas fa-eye me-1"></i>View
                                </button>
                            </div>
                        </div>

                        <!-- Due Today -->
                        <div class="vaccine-item due-today">
                            <div class="vaccine-avatar">LJ</div>
                            <div class="vaccine-details">
                                <div class="child-name">Liam Johnson (9 months)</div>
                                <div class="vaccine-info">
                                    <i class="fas fa-syringe me-1"></i>9-Month Vaccines • 
                                    <i class="fas fa-calendar me-1"></i>Due: Today •
                                    <i class="fas fa-user me-1"></i>Guardian: Sarah Johnson
                                </div>
                            </div>
                            <div class="vaccine-status status-due-today">DUE TODAY</div>
                            <div class="vaccine-actions">
                                <button class="btn-sm-custom btn-administer" onclick="administerVaccine('liam', '9month')">
                                    <i class="fas fa-syringe me-1"></i>Administer
                                </button>
                                <button class="btn-sm-custom btn-view" onclick="viewChild('liam')">
                                    <i class="fas fa-eye me-1"></i>View
                                </button>
                                <button class="btn-sm-custom btn-postpone" onclick="postponeVaccine('liam', '9month')">
                                    <i class="fas fa-clock me-1"></i>Postpone
                                </button>
                            </div>
                        </div>

                        <!-- Due Soon -->
                        <div class="vaccine-item due-soon">
                            <div class="vaccine-avatar">AS</div>
                            <div class="vaccine-details">
                                <div class="child-name">Alex Smith (2 years)</div>
                                <div class="vaccine-info">
                                    <i class="fas fa-syringe me-1"></i>MMR (1st dose) • 
                                    <i class="fas fa-calendar me-1"></i>Due: Tomorrow •
                                    <i class="fas fa-user me-1"></i>Guardian: Michael Smith
                                </div>
                            </div>
                            <div class="vaccine-status status-due-soon">DUE SOON</div>
                            <div class="vaccine-actions">
                                <button class="btn-sm-custom btn-administer" onclick="administerVaccine('alex', 'mmr1')">
                                    <i class="fas fa-syringe me-1"></i>Administer
                                </button>
                                <button class="btn-sm-custom btn-view" onclick="viewChild('alex')">
                                    <i class="fas fa-eye me-1"></i>View
                                </button>
                            </div>
                        </div>

                        <div class="vaccine-item due-soon">
                            <div class="vaccine-avatar">MR</div>
                            <div class="vaccine-details">
                                <div class="child-name">Maya Rodriguez (6 months)</div>
                                <div class="vaccine-info">
                                    <i class="fas fa-syringe me-1"></i>6-Month Vaccines • 
                                    <i class="fas fa-calendar me-1"></i>Due: In 2 days •
                                    <i class="fas fa-user me-1"></i>Guardian: Carlos Rodriguez
                                </div>
                            </div>
                            <div class="vaccine-status status-due-soon">DUE SOON</div>
                            <div class="vaccine-actions">
                                <button class="btn-sm-custom btn-administer" onclick="administerVaccine('maya', '6month')">
                                    <i class="fas fa-syringe me-1"></i>Administer
                                </button>
                                <button class="btn-sm-custom btn-view" onclick="viewChild('maya')">
                                    <i class="fas fa-eye me-1"></i>View
                                </button>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <a href="all-due-vaccines.html" class="btn btn-outline-primary">
                                <i class="fas fa-list me-1"></i>View All Due Vaccines (47)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="row">
            <!-- Recent Activity -->
            <div class="col-md-6 col-lg-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">Recent Activity</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">View All</a>
                                <a class="dropdown-item" href="#">Export</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="activity-item">
                            <div class="activity-icon completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title">DTaP vaccine administered to Emma Johnson</div>
                                <div class="activity-time">2 minutes ago</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon registered">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title">New child registered: Baby Rodriguez</div>
                                <div class="activity-time">15 minutes ago</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon completed">
                                <i class="fas fa-syringe"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title">6-month vaccines given to Maya Rodriguez</div>
                                <div class="activity-time">32 minutes ago</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon scheduled">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title">Appointment scheduled for Alex Smith</div>
                                <div class="activity-time">1 hour ago</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title">MMR vaccine administered to Sophie Chen</div>
                                <div class="activity-time">1 hour ago</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon registered">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title">Vaccination record updated for Liam Johnson</div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-md-6 col-lg-6 order-1 mb-4">
                <div class="card h-100 ">
                    <div class="card-header">
                        <h5 class="m-0">Quick Actions</h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="registerNewChild()">
                                    <i class="fas fa-user-plus fa-2x mb-2"></i>
                                    <span>Register New Child</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="quickVaccination()">
                                    <i class="fas fa-syringe fa-2x mb-2"></i>
                                    <span>Quick Vaccination</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="viewReports()">
                                    <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                    <span>View Reports</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center" onclick="searchChild()">
                                    <i class="fas fa-search fa-2x mb-2"></i>
                                    <span>Search Child</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Bulk Actions -->
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="mb-3">Bulk Operations</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-secondary" onclick="bulkUpdateRecords()">
                                    <i class="fas fa-edit me-2"></i>Bulk Update Records
                                </button>
                                <button class="btn btn-outline-secondary" onclick="generateReports()">
                                    <i class="fas fa-file-export me-2"></i>Generate Batch Reports
                                </button>
                                <button class="btn btn-outline-secondary" onclick="sendReminders()">
                                    <i class="fas fa-paper-plane me-2"></i>Send Reminder Notifications
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Administer Vaccine Modal -->
    <div class="modal fade" id="administerVaccineModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Administer Vaccine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="administerForm">
                        <div class="mb-3">
                            <label class="form-label">Child Name</label>
                            <input type="text" class="form-control" id="childName" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vaccine</label>
                            <input type="text" class="form-control" id="vaccineName" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date Administered</label>
                            <input type="date" class="form-control" id="dateAdministered" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lot Number</label>
                            <input type="text" class="form-control" id="lotNumber" placeholder="Vaccine lot number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Site of Administration</label>
                            <select class="form-control" id="adminSite">
                                <option value="">Select site</option>
                                <option value="left-arm">Left Arm</option>
                                <option value="right-arm">Right Arm</option>
                                <option value="left-thigh">Left Thigh</option>
                                <option value="right-thigh">Right Thigh</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" id="adminNotes" rows="3" placeholder="Any reactions or notes..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="confirmAdministration()">
                        <i class="fas fa-syringe me-1"></i>Confirm Administration
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Register New Child Modal -->
    <div class="modal fade" id="registerChildModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register New Child</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="regFirstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="regLastName" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="regDOB" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-control" id="regGender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian Name</label>
                            <input type="text" class="form-control" id="regGuardianName" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Guardian Phone</label>
                                <input type="tel" class="form-control" id="regGuardianPhone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Guardian Email</label>
                                <input type="email" class="form-control" id="regGuardianEmail">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="regAddress" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmRegistration()">
                        <i class="fas fa-user-plus me-1"></i>Register Child
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notifications -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div id="successToast" class="toast toast-success" role="alert">
            <div class="toast-body text-white">
                <i class="fas fa-check-circle me-2"></i>
                <span id="successMessage">Operation completed successfully!</span>
            </div>
        </div>
        <div id="errorToast" class="toast toast-error" role="alert">
            <div class="toast-body text-white">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span id="errorMessage">An error occurred!</span>
            </div>
        </div>
    </div>
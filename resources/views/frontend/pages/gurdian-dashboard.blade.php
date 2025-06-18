<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Vaccination Dashboard - VaxTracker</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #7C3AED;
            --accent-color: #818CF8;
            --background-light: #F5F3FF;
            --text-primary: #1F2937;
            --text-secondary: #4B5563;
            --primary-hover: #4338CA;
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --danger-color: #EF4444;
            --soft-gray: #F8F9FA;
            --border-light: #E5E7EB;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: var(--background-light);
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: white !important;
            font-weight: 600;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--accent-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .user-menu {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            background: white;
            color: var(--primary-color);
        }

        /* Main Container */
        .dashboard-container {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        /* Welcome Section */
        .welcome-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.1);
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .welcome-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* Child Overview Cards */
        .children-overview {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .child-overview-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .child-overview-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(79, 70, 229, 0.15);
        }

        .child-header {
            display: flex;
            align-items: center;
            justify-content: between;
            margin-bottom: 1.5rem;
        }

        .child-info {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .child-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin-right: 1.5rem;
            flex-shrink: 0;
        }

        .child-details h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .child-age {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .vaccination-summary {
            background: var(--background-light);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .summary-text {
            font-weight: 600;
            color: var(--text-primary);
        }

        .summary-fraction {
            font-size: 1.2rem;
            color: var(--success-color);
        }

        .child-actions {
            display: flex;
            gap: 1rem;
            margin-left: auto;
            flex-direction: column;
        }

        .btn-view-profile {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            white-space: nowrap;
        }

        .btn-view-profile:hover {
            background: var(--primary-hover);
            color: white;
            transform: translateY(-2px);
        }

        .btn-download {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            white-space: nowrap;
        }

        .btn-download:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Progress Tracker */
        .progress-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.1);
        }

        .vaccination-timeline {
            position: relative;
            margin: 2rem 0;
        }

        .timeline-line {
            position: absolute;
            top: 30px;
            left: 30px;
            right: 30px;
            height: 4px;
            background: var(--border-light);
            border-radius: 2px;
        }

        .timeline-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: linear-gradient(135deg, var(--success-color), #34D399);
            border-radius: 2px;
            transition: width 1s ease;
        }

        .timeline-items {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        .timeline-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            max-width: 120px;
        }

        .timeline-point {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            border: 4px solid white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .timeline-point.completed {
            background: var(--success-color);
        }

        .timeline-point.current {
            background: var(--warning-color);
            animation: pulse 2s infinite;
        }

        .timeline-point.pending {
            background: var(--border-light);
            color: var(--text-secondary);
        }

        .timeline-label {
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .timeline-label.completed {
            color: var(--success-color);
            font-weight: 600;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Upcoming Vaccines */
        .upcoming-vaccines {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.1);
        }

        .vaccine-item {
            display: flex;
            align-items: center;
            padding: 1.25rem;
            background: var(--background-light);
            border-radius: 15px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            border-left: 4px solid var(--accent-color);
        }

        .vaccine-item:hover {
            transform: translateX(5px);
            background: white;
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.1);
        }

        .vaccine-item.overdue {
            border-left-color: var(--danger-color);
            background: rgba(239, 68, 68, 0.05);
        }

        .vaccine-item.due-soon {
            border-left-color: var(--warning-color);
            background: rgba(245, 158, 11, 0.05);
        }

        .vaccine-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 1.2rem;
        }

        .vaccine-icon.overdue {
            background: var(--danger-color);
        }

        .vaccine-icon.due-soon {
            background: var(--warning-color);
        }

        .vaccine-icon.scheduled {
            background: var(--primary-color);
        }

        .vaccine-details {
            flex: 1;
        }

        .vaccine-name {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .vaccine-info {
            color: var(--text-secondary);
            font-size: 0.9rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .vaccine-status {
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-right: 1rem;
        }

        .status-overdue {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .status-due-soon {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .status-scheduled {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
        }

        .vaccine-actions {
            display: flex;
            gap: 0.5rem;
            flex-direction: column;
        }

        .btn-vaccine-action {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            text-align: center;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-mark-given {
            background: var(--success-color);
            color: white;
        }

        .btn-mark-given:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-remind {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-remind:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Alerts Panel */
        .alerts-panel {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.1);
        }

        .alert-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 15px;
            margin-bottom: 1rem;
            border-left: 4px solid;
            position: relative;
        }

        .alert-critical {
            background: rgba(239, 68, 68, 0.05);
            border-left-color: var(--danger-color);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.05);
            border-left-color: var(--warning-color);
        }

        .alert-info {
            background: rgba(79, 70, 229, 0.05);
            border-left-color: var(--primary-color);
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            position: relative;
        }

        .alert-critical .alert-icon {
            background: var(--danger-color);
        }

        .alert-warning .alert-icon {
            background: var(--warning-color);
        }

        .alert-info .alert-icon {
            background: var(--primary-color);
        }

        .red-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            border: 2px solid white;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--text-primary);
        }

        .alert-message {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .alert-time {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-left: auto;
        }

        /* QR Code Section */
        .qr-section {
            background: var(--background-light);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            margin-top: 1rem;
        }

        .qr-code {
            width: 120px;
            height: 120px;
            background: white;
            border: 2px solid var(--border-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 4rem;
            color: var(--text-secondary);
        }

        .qr-title {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .qr-subtitle {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: -75px;
            left: 0;
            width: 100%;
            height: 75px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            clip-path: ellipse(100% 100% at 50% 100%);
        }

        .footer-content {
            position: relative;
            z-index: 2;
        }

        .footer h5 {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 0.5rem;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem 0;
            }

            .welcome-section,
            .child-overview-card,
            .progress-section,
            .upcoming-vaccines,
            .alerts-panel {
                padding: 1.5rem;
            }

            .child-header {
                flex-direction: column;
                text-align: center;
            }

            .child-actions {
                flex-direction: row;
                margin-left: 0;
                margin-top: 1rem;
            }

            .timeline-items {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .timeline-item {
                flex: none;
                width: calc(50% - 0.5rem);
            }

            .timeline-line {
                display: none;
            }

            .vaccine-item {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .vaccine-actions {
                flex-direction: row;
                justify-content: center;
            }

            .alert-item {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .alert-time {
                margin-left: 0;
            }
        }

        @media (max-width: 480px) {
            .welcome-title {
                font-size: 1.5rem;
            }

            .child-actions {
                flex-direction: column;
            }

            .timeline-item {
                width: 100%;
            }

            .vaccine-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-syringe me-2"></i>VaxTracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.html">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register-child.html">
                            <i class="fas fa-user-plus me-1"></i>Register Child
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.html">
                            <i class="fas fa-calendar-alt me-1"></i>Schedule
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="notifications.html">
                            <i class="fas fa-bell me-1"></i>Notifications
                            <span class="notification-badge">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.html">
                            <i class="fas fa-user me-1"></i>Profile
                        </a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a class="nav-link" href="logout.html">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard -->
    <main class="dashboard-container">
        <div class="container">
            
            <!-- Welcome Message -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="welcome-title">Welcome, Sarah Johnson</h1>
                        <p class="welcome-subtitle">Keep your children healthy and protected with up-to-date vaccinations</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            Today: <strong>March 15, 2024</strong>
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
                
                <!-- Child 1: Emma -->
                <div class="child-overview-card">
                    <div class="child-header">
                        <div class="child-info">
                            <div class="child-avatar">
                                <i class="fas fa-child"></i>
                            </div>
                            <div class="child-details">
                                <h3>Emma Johnson</h3>
                                <div class="child-age">4 years, 3 days old • Born: March 12, 2020</div>
                                <div class="vaccination-summary">
                                    <span class="summary-text">Vaccination Progress:</span>
                                    <span class="summary-fraction">12/15</span>
                                    <span class="summary-text">vaccines completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="child-actions">
                            <a href="child-profile.html?id=1" class="btn-view-profile">
                                <i class="fas fa-eye me-1"></i>View Full Profile
                            </a>
                            <a href="#" class="btn-download" onclick="downloadCertificate(1)">
                                <i class="fas fa-download me-1"></i>Download PDF
                            </a>
                        </div>
                    </div>
                    
                    <!-- QR Code Section -->
                    <div class="qr-section">
                        <div class="qr-code">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <div class="qr-title">Digital Vaccine Certificate</div>
                        <div class="qr-subtitle">Scan to view Emma's complete vaccination record</div>
                    </div>
                </div>

                <!-- Child 2: Liam -->
                <div class="child-overview-card">
                    <div class="child-header">
                        <div class="child-info">
                            <div class="child-avatar">
                                <i class="fas fa-baby"></i>
                            </div>
                            <div class="child-details">
                                <h3>Liam Johnson</h3>
                                <div class="child-age">8 months, 7 days old • Born: July 8, 2023</div>
                                <div class="vaccination-summary">
                                    <span class="summary-text">Vaccination Progress:</span>
                                    <span class="summary-fraction">6/8</span>
                                    <span class="summary-text">vaccines completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="child-actions">
                            <a href="child-profile.html?id=2" class="btn-view-profile">
                                <i class="fas fa-eye me-1"></i>View Full Profile
                            </a>
                            <a href="#" class="btn-download" onclick="downloadCertificate(2)">
                                <i class="fas fa-download me-1"></i>Download PDF
                            </a>
                        </div>
                    </div>
                    
                    <!-- QR Code Section -->
                    <div class="qr-section">
                        <div class="qr-code">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <div class="qr-title">Digital Vaccine Certificate</div>
                        <div class="qr-subtitle">Scan to view Liam's complete vaccination record</div>
                    </div>
                </div>
            </div>

            <!-- Vaccination Progress Tracker -->
            <div class="progress-section">
                <h2 class="section-title">
                    <i class="fas fa-chart-line"></i>
                    Vaccination Progress Tracker
                </h2>
                <p class="text-muted mb-4">Track your children's vaccination milestones and progress</p>
                
                <div class="vaccination-timeline">
                    <div class="timeline-line">
                        <div class="timeline-progress" style="width: 60%"></div>
                    </div>
                    <div class="timeline-items">
                        <div class="timeline-item">
                            <div class="timeline-point completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-label completed">Birth - 2 Months</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-point completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-label completed">4 - 6 Months</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-point current">
                                <i class="fas fa-syringe"></i>
                            </div>
                            <div class="timeline-label">12 - 15 Months</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-point pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="timeline-label">4 - 6 Years</div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-point pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="timeline-label">11 - 18 Years</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Vaccines Section -->
            <div class="upcoming-vaccines">
                <h2 class="section-title">
                    <i class="fas fa-calendar-check"></i>
                    Upcoming Vaccines (Next 30 Days)
                </h2>
                
                <div class="vaccine-item overdue">
                    <div class="vaccine-icon overdue">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="vaccine-details">
                        <div class="vaccine-name">DTaP (5th dose) - Emma</div>
                        <div class="vaccine-info">
                            <span><i class="fas fa-calendar me-1"></i>Due: March 12, 2024</span>
                            <span><i class="fas fa-clock me-1"></i>3 days overdue</span>
                        </div>
                    </div>
                    <div class="vaccine-status status-overdue">OVERDUE</div>
                    <div class="vaccine-actions">
                        <button class="btn-vaccine-action btn-mark-given" onclick="markAsGiven('dtap5', 'emma')">
                            <i class="fas fa-check me-1"></i>Mark as Given
                        </button>
                        <button class="btn-vaccine-action btn-remind" onclick="setReminder('dtap5', 'emma')">
                            <i class="fas fa-bell me-1"></i>Remind Me
                        </button>
                    </div>
                </div>

                <div class="vaccine-item due-soon">
                    <div class="vaccine-icon due-soon">
                        <i class="fas fa-exclamation"></i>
                    </div>
                    <div class="vaccine-details">
                        <div class="vaccine-name">MMR (2nd dose) - Emma</div>
                        <div class="vaccine-info">
                            <span><i class="fas fa-calendar me-1"></i>Due: March 20, 2024</span>
                            <span><i class="fas fa-clock me-1"></i>Due in 5 days</span>
                        </div>
                    </div>
                    <div class="vaccine-status status-due-soon">DUE SOON</div>
                    <div class="vaccine-actions">
                        <button class="btn-vaccine-action btn-mark-given" onclick="markAsGiven('mmr2', 'emma')">
                            <i class="fas fa-check me-1"></i>Mark as Given
                        </button>
                        <button class="btn-vaccine-action btn-remind" onclick="setReminder('mmr2', 'emma')">
                            <i class="fas fa-bell me-1"></i>Remind Me
                        </button>
                    </div>
                </div>

                <div class="vaccine-item scheduled">
                    <div class="vaccine-icon scheduled">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div class="vaccine-details">
                        <div class="vaccine-name">9-Month Vaccines - Liam</div>
                        <div class="vaccine-info">
                            <span><i class="fas fa-calendar me-1"></i>Scheduled: March 25, 2024</span>
                            <span><i class="fas fa-map-marker-alt me-1"></i>Family Health Clinic</span>
                        </div>
                    </div>
                    <div class="vaccine-status status-scheduled">SCHEDULED</div>
                    <div class="vaccine-actions">
                        <button class="btn-vaccine-action btn-mark-given" onclick="markAsGiven('9month', 'liam')">
                            <i class="fas fa-check me-1"></i>Mark as Given
                        </button>
                        <button class="btn-vaccine-action btn-remind" onclick="setReminder('9month', 'liam')">
                            <i class="fas fa-bell me-1"></i>Remind Me
                        </button>
                    </div>
                </div>

                <div class="vaccine-item scheduled">
                    <div class="vaccine-icon scheduled">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div class="vaccine-details">
                        <div class="vaccine-name">Annual Flu Vaccine - Both Children</div>
                        <div class="vaccine-info">
                            <span><i class="fas fa-calendar me-1"></i>Recommended: April 1, 2024</span>
                            <span><i class="fas fa-info-circle me-1"></i>Seasonal protection</span>
                        </div>
                    </div>
                    <div class="vaccine-status status-scheduled">SEASONAL</div>
                    <div class="vaccine-actions">
                        <button class="btn-vaccine-action btn-mark-given" onclick="markAsGiven('flu', 'both')">
                            <i class="fas fa-check me-1"></i>Mark as Given
                        </button>
                        <button class="btn-vaccine-action btn-remind" onclick="setReminder('flu', 'both')">
                            <i class="fas fa-bell me-1"></i>Remind Me
                        </button>
                    </div>
                </div>
            </div>

            <!-- Alerts & Notifications Panel -->
            <div class="alerts-panel">
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
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <h5><i class="fas fa-syringe me-2"></i>VaxTracker</h5>
                        <p>Making vaccination tracking simple, secure, and accessible for all families.</p>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-4">
                        <h5>Quick Links</h5>
                        <div class="footer-links">
                            <a href="dashboard.html">Dashboard</a>
                            <a href="register-child.html">Register Child</a>
                            <a href="schedule.html">Schedule</a>
                            <a href="help.html">Help Center</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-4">
                        <h5>Support</h5>
                        <div class="footer-links">
                            <a href="faq.html">FAQ</a>
                            <a href="contact.html">Contact Us</a>
                            <a href="support.html">Live Chat</a>
                            <a href="help.html">Help Guide</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <h5>Contact Information</h5>
                        <p><i class="fas fa-phone me-2"></i>1-800-VAX-TRACK</p>
                        <p><i class="fas fa-envelope me-2"></i>support@vaxtracker.com</p>
                        <p><i class="fas fa-map-marker-alt me-2"></i>123 Health Street, Medical City, HC 12345</p>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; 2024 VaxTracker. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-links d-inline">
                            <a href="privacy.html" class="me-3">Privacy Policy</a>
                            <a href="terms.html" class="me-3">Terms of Service</a>
                            <a href="accessibility.html">Accessibility</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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
</body>
</html>
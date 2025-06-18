<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Child - VaxTracker</title>
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

        /* Main Container */
        .register-container {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        .page-header {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.1);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Progress Steps */
        .progress-wrapper {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.1);
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
        }

        .progress-line {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border-light);
            z-index: 1;
        }

        .progress-line-active {
            height: 2px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            transition: width 0.5s ease;
            z-index: 2;
            position: absolute;
            top: 50%;
            left: 0;
        }

        .step {
            background: var(--border-light);
            color: var(--text-secondary);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            position: relative;
            z-index: 3;
            transition: all 0.3s ease;
        }

        .step.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: scale(1.1);
        }

        .step.completed {
            background: var(--success-color);
            color: white;
        }

        .step-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
        }

        .step-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            text-align: center;
            flex: 1;
        }

        .step-label.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Form Container */
        .form-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.1);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .step-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            display: block;
        }

        .required {
            color: var(--danger-color);
        }

        .form-control {
            border: 2px solid var(--border-light);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        }

        .form-text {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }

        .input-group {
            display: flex;
            gap: 1rem;
        }

        .input-group .form-control {
            flex: 1;
        }

        /* Photo Upload */
        .photo-upload {
            text-align: center;
            padding: 2rem;
            border: 2px dashed var(--border-light);
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .photo-upload:hover {
            border-color: var(--primary-color);
            background: var(--background-light);
        }

        .photo-upload.has-image {
            border-color: var(--success-color);
            background: rgba(16, 185, 129, 0.05);
        }

        .photo-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            display: none;
            border: 4px solid var(--success-color);
        }

        .upload-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--background-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--primary-color);
            font-size: 2rem;
        }

        .upload-text {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .upload-hint {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* Vaccination History */
        .vaccination-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .option-card {
            background: var(--background-light);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .option-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.1);
        }

        .option-card.selected {
            border-color: var(--primary-color);
            background: white;
        }

        .option-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }

        .option-title {
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .option-description {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        /* File Upload */
        .file-upload-area {
            background: var(--background-light);
            border: 2px dashed var(--border-light);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            margin: 1rem 0;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background: white;
        }

        .file-upload-area.drag-over {
            border-color: var(--success-color);
            background: rgba(16, 185, 129, 0.05);
        }

        .upload-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-button:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Emergency Contacts */
        .contact-card {
            background: var(--background-light);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--border-light);
        }

        .contact-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .contact-title {
            font-weight: 600;
            color: var(--text-primary);
        }

        .remove-contact {
            background: var(--danger-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-contact:hover {
            transform: scale(1.1);
        }

        .add-contact-btn {
            border: 2px dashed var(--primary-color);
            background: transparent;
            color: var(--primary-color);
            border-radius: 15px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-weight: 600;
        }

        .add-contact-btn:hover {
            background: var(--background-light);
            border-color: var(--primary-hover);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 3rem;
            gap: 1rem;
        }

        /* Success Message */
        .success-container {
            text-align: center;
            padding: 2rem 0;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--success-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 3rem;
            animation: successPulse 2s infinite;
        }

        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .success-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .success-message {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .child-summary {
            background: var(--background-light);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-light);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-weight: 600;
            color: var(--text-primary);
        }

        .summary-value {
            color: var(--text-secondary);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-container {
                padding: 1rem 0;
            }

            .page-header,
            .progress-wrapper,
            .form-container {
                padding: 1.5rem;
                margin: 1rem;
            }

            .step-labels {
                font-size: 0.75rem;
            }

            .input-group {
                flex-direction: column;
            }

            .btn-actions {
                flex-direction: column;
            }

            .btn-actions button {
                width: 100%;
            }

            .vaccination-options {
                grid-template-columns: 1fr;
            }

            .step-title {
                font-size: 1.5rem;
            }

            .contact-card {
                padding: 1rem;
            }
        }

        /* Loading States */
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Form Validation */
        .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .form-control.is-valid {
            border-color: var(--success-color);
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .valid-feedback {
            color: var(--success-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
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
                        <a class="nav-link" href="dashboard.html">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="register-child.html">
                            <i class="fas fa-user-plus me-1"></i>Register Child
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.html">
                            <i class="fas fa-calendar-alt me-1"></i>Schedule
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notifications.html">
                            <i class="fas fa-bell me-1"></i>Notifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.html">
                            <i class="fas fa-user me-1"></i>Profile
                        </a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a class="nav-link" href="dashboard.html">
                        <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="register-container">
        <div class="container">
            
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Register a New Child</h1>
                <p class="page-subtitle">Add your child to VaxTracker to start monitoring their vaccination schedule and health records</p>
            </div>

            <!-- Progress Bar -->
            <div class="progress-wrapper">
                <div class="progress-steps">
                    <div class="progress-line"></div>
                    <div class="progress-line-active" id="progressLine"></div>
                    <div class="step active" id="step1">1</div>
                    <div class="step" id="step2">2</div>
                    <div class="step" id="step3">3</div>
                    <div class="step" id="step4">4</div>
                    <div class="step" id="step5">5</div>
                </div>
                <div class="step-labels">
                    <div class="step-label active">Basic Info</div>
                    <div class="step-label">Medical Info</div>
                    <div class="step-label">Vaccination History</div>
                    <div class="step-label">Emergency Contacts</div>
                    <div class="step-label">Complete</div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                
                <!-- Step 1: Basic Information -->
                <div class="step-content active" id="content1">
                    <h2 class="step-title">Basic Information</h2>
                    <p class="step-subtitle">Tell us about your child's basic details</p>
                    
                    <form id="basicInfoForm">
                        <!-- Child Photo -->
                        <div class="form-group">
                            <label class="form-label">Child's Photo (Optional)</label>
                            <div class="photo-upload" onclick="selectPhoto()">
                                <img id="photoPreview" class="photo-preview" alt="Child photo">
                                <div class="upload-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <div class="upload-text">Upload Photo</div>
                                <div class="upload-hint">Click to select a photo (JPG, PNG - Max 5MB)</div>
                                <input type="file" id="childPhoto" accept="image/*" style="display: none;" onchange="previewPhoto(event)">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">First Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth <span class="required">*</span></label>
                                    <input type="date" class="form-control" id="dateOfBirth" required onchange="calculateAge()">
                                    <div class="form-text" id="ageDisplay"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Gender</label>
                                    <select class="form-control form-select" id="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                        <option value="prefer-not-to-say">Prefer not to say</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Relationship to Child <span class="required">*</span></label>
                            <select class="form-control form-select" id="relationship" required>
                                <option value="">Select Relationship</option>
                                <option value="mother">Mother</option>
                                <option value="father">Father</option>
                                <option value="guardian">Legal Guardian</option>
                                <option value="grandparent">Grandparent</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Place of Birth</label>
                                    <input type="text" class="form-control" id="placeOfBirth" placeholder="City, State">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Birth Certificate Number</label>
                                    <input type="text" class="form-control" id="birthCertificate">
                                    <div class="form-text">Optional - helps with verification</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Step 2: Medical Information -->
                <div class="step-content" id="content2">
                    <h2 class="step-title">Medical Information</h2>
                    <p class="step-subtitle">Healthcare provider and medical details</p>
                    
                    <form id="medicalInfoForm">
                        <div class="form-group">
                            <label class="form-label">Primary Pediatrician/Healthcare Provider</label>
                            <input type="text" class="form-control" id="primaryDoctor" placeholder="Dr. Smith's Pediatric Clinic">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Doctor's Phone</label>
                                    <input type="tel" class="form-control" id="doctorPhone" placeholder="(555) 123-4567">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Clinic/Hospital Address</label>
                                    <input type="text" class="form-control" id="clinicAddress" placeholder="123 Medical Center Dr">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Insurance Provider</label>
                                    <input type="text" class="form-control" id="insuranceProvider" placeholder="Blue Cross Blue Shield">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Insurance ID Number</label>
                                    <input type="text" class="form-control" id="insuranceId">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Known Allergies</label>
                            <textarea class="form-control" id="allergies" rows="3" placeholder="List any known allergies (medications, foods, environmental)"></textarea>
                            <div class="form-text">Include any allergic reactions to vaccines or medications</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Medical Conditions</label>
                            <textarea class="form-control" id="medicalConditions" rows="3" placeholder="Any chronic conditions, disabilities, or ongoing medical treatments"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Current Medications</label>
                            <textarea class="form-control" id="medications" rows="2" placeholder="List current medications and dosages"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Step 3: Vaccination History -->
                <div class="step-content" id="content3">
                    <h2 class="step-title">Vaccination History</h2>
                    <p class="step-subtitle">Do you have existing vaccination records for this child?</p>
                    
                    <div class="vaccination-options">
                        <div class="option-card" data-option="no-history">
                            <div class="option-icon">
                                <i class="fas fa-baby"></i>
                            </div>
                            <h4 class="option-title">No Previous Records</h4>
                            <p class="option-description">This is a newborn or I don't have previous vaccination records</p>
                        </div>
                        
                        <div class="option-card" data-option="has-records">
                            <div class="option-icon">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <h4 class="option-title">I Have Records</h4>
                            <p class="option-description">I have vaccination records I'd like to upload or enter manually</p>
                        </div>
                        
                        <div class="option-card" data-option="transfer-records">
                            <div class="option-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <h4 class="option-title">Transfer from Provider</h4>
                            <p class="option-description">Request records from previous healthcare provider</p>
                        </div>
                    </div>
                    
                    <!-- File Upload Section (Hidden by default) -->
                    <div id="fileUploadSection" style="display: none;">
                        <h4>Upload Vaccination Records</h4>
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">Drag & drop files here or click to browse</div>
                            <div class="upload-hint">Accepted formats: PDF, JPG, PNG (Max 10MB per file)</div>
                            <input type="file" id="vaccinationFiles" multiple accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                            <button type="button" class="upload-button mt-3" onclick="document.getElementById('vaccinationFiles').click()">
                                Choose Files
                            </button>
                        </div>
                        <div id="fileList" class="mt-3"></div>
                    </div>
                    
                    <!-- Manual Entry Section (Hidden by default) -->
                    <div id="manualEntrySection" style="display: none;">
                        <h4>Enter Vaccination Manually</h4>
                        <p class="text-muted">You can add individual vaccinations after registration is complete</p>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Don't worry if you don't have all records now. You can add them later from your dashboard.
                        </div>
                    </div>
                </div>

                <!-- Step 4: Emergency Contacts -->
                <div class="step-content" id="content4">
                    <h2 class="step-title">Emergency Contacts</h2>
                    <p class="step-subtitle">Add people who can be contacted in case of emergency</p>
                    
                    <div id="emergencyContactsContainer">
                        <!-- Emergency contacts will be added here -->
                    </div>
                    
                    <button type="button" class="add-contact-btn" onclick="addEmergencyContact()">
                        <i class="fas fa-plus me-2"></i>Add Emergency Contact
                    </button>
                    
                    <div class="form-group mt-4">
                        <label class="form-label">Special Instructions</label>
                        <textarea class="form-control" id="specialInstructions" rows="3" placeholder="Any special medical instructions or notes for emergency situations"></textarea>
                    </div>
                </div>

                <!-- Step 5: Complete -->
                <div class="step-content" id="content5">
                    <div class="success-container">
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <h2 class="success-title">Registration Successful!</h2>
                        <p class="success-message">Your child has been successfully registered in VaxTracker</p>
                        
                        <div class="child-summary">
                            <h4 class="text-center mb-3">Registration Summary</h4>
                            <div class="summary-item">
                                <span class="summary-label">Child Name:</span>
                                <span class="summary-value" id="summaryName">-</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Date of Birth:</span>
                                <span class="summary-value" id="summaryDOB">-</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Age:</span>
                                <span class="summary-value" id="summaryAge">-</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Primary Doctor:</span>
                                <span class="summary-value" id="summaryDoctor">-</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Emergency Contacts:</span>
                                <span class="summary-value" id="summaryContacts">-</span>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-4" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>What's Next?</strong><br>
                            We'll analyze your child's age and create a personalized vaccination schedule. Check your dashboard for upcoming vaccines and reminders.
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <a href="dashboard.html" class="btn btn-primary btn-lg">
                                <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                            </a>
                            <a href="register-child.html" class="btn btn-secondary">
                                <i class="fas fa-plus me-2"></i>Register Another Child
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="btn-actions">
                    <button type="button" class="btn btn-secondary" id="prevBtn" onclick="previousStep()" style="display: none;">
                        <i class="fas fa-arrow-left me-2"></i>Previous
                    </button>
                    <div></div>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextStep()">
                        Next <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let currentStep = 1;
        let selectedVaccinationOption = '';
        let emergencyContactCount = 0;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateProgressBar();
            addEmergencyContact(); // Add first emergency contact by default
            
            // Vaccination option selection handlers
            document.querySelectorAll('.option-card').forEach(card => {
                card.addEventListener('click', function() {
                    // Remove active class from all cards
                    document.querySelectorAll('.option-card').forEach(c => c.classList.remove('selected'));
                    // Add active class to clicked card
                    this.classList.add('selected');
                    selectedVaccinationOption = this.dataset.option;
                    
                    // Show/hide relevant sections
                    toggleVaccinationSections();
                });
            });

            // File upload handlers
            setupFileUpload();
        });

        function nextStep() {
            if (validateCurrentStep()) {
                if (currentStep < 5) {
                    currentStep++;
                    showStep(currentStep);
                    updateProgressBar();
                }
            }
        }

        function previousStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                updateProgressBar();
            }
        }

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Show current step
            document.getElementById(`content${step}`).classList.add('active');
            
            // Update button visibility
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            
            if (step === 1) {
                prevBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'block';
            }
            
            if (step === 5) {
                nextBtn.style.display = 'none';
                // Populate summary
                populateSummary();
            } else {
                nextBtn.style.display = 'block';
                nextBtn.innerHTML = step === 4 ? 'Complete Registration <i class="fas fa-check ms-2"></i>' : 'Next <i class="fas fa-arrow-right ms-2"></i>';
            }
        }

        function updateProgressBar() {
            // Update step indicators
            for (let i = 1; i <= 5; i++) {
                const step = document.getElementById(`step${i}`);
                const label = document.querySelectorAll('.step-label')[i-1];
                
                if (i < currentStep) {
                    step.className = 'step completed';
                    step.innerHTML = '<i class="fas fa-check"></i>';
                    label.classList.remove('active');
                } else if (i === currentStep) {
                    step.className = 'step active';
                    step.innerHTML = i;
                    label.classList.add('active');
                } else {
                    step.className = 'step';
                    step.innerHTML = i;
                    label.classList.remove('active');
                }
            }
            
            // Update progress line
            const progressLine = document.getElementById('progressLine');
            const width = ((currentStep - 1) / 4) * 100;
            progressLine.style.width = width + '%';
        }

        function validateCurrentStep() {
            switch(currentStep) {
                case 1:
                    return validateBasicInfo();
                case 2:
                    return validateMedicalInfo();
                case 3:
                    return validateVaccinationHistory();
                case 4:
                    return validateEmergencyContacts();
                default:
                    return true;
            }
        }

        function validateBasicInfo() {
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const dateOfBirth = document.getElementById('dateOfBirth').value;
            const relationship = document.getElementById('relationship').value;
            
            if (!firstName || !lastName || !dateOfBirth || !relationship) {
                showNotification('error', 'Please fill in all required fields');
                return false;
            }
            
            // Validate age (not future date)
            const birthDate = new Date(dateOfBirth);
            const today = new Date();
            if (birthDate > today) {
                showNotification('error', 'Birth date cannot be in the future');
                return false;
            }
            
            return true;
        }

        function validateMedicalInfo() {
            // Medical info is mostly optional, but validate format if provided
            return true;
        }

        function validateVaccinationHistory() {
            if (!selectedVaccinationOption) {
                showNotification('error', 'Please select a vaccination history option');
                return false;
            }
            return true;
        }

        function validateEmergencyContacts() {
            const contacts = document.querySelectorAll('.contact-card');
            if (contacts.length === 0) {
                showNotification('error', 'Please add at least one emergency contact');
                return false;
            }
            
            // Validate each contact has required fields
            for (let contact of contacts) {
                const name = contact.querySelector('input[placeholder*="Name"]').value.trim();
                const phone = contact.querySelector('input[placeholder*="Phone"]').value.trim();
                if (!name || !phone) {
                    showNotification('error', 'Please complete all emergency contact information');
                    return false;
                }
            }
            
            return true;
        }

        // Photo upload functions
        function selectPhoto() {
            document.getElementById('childPhoto').click();
        }

        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    
                    // Hide upload icon and text
                    const uploadArea = document.querySelector('.photo-upload');
                    uploadArea.classList.add('has-image');
                    uploadArea.querySelector('.upload-icon').style.display = 'none';
                    uploadArea.querySelector('.upload-text').style.display = 'none';
                    uploadArea.querySelector('.upload-hint').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        }

        // Age calculation
        function calculateAge() {
            const birthDate = new Date(document.getElementById('dateOfBirth').value);
            const today = new Date();
            
            if (birthDate > today) {
                document.getElementById('ageDisplay').textContent = '';
                return;
            }
            
            const ageInMonths = (today.getFullYear() - birthDate.getFullYear()) * 12 + 
                               (today.getMonth() - birthDate.getMonth());
            
            if (ageInMonths < 12) {
                document.getElementById('ageDisplay').textContent = `Age: ${ageInMonths} month${ageInMonths !== 1 ? 's' : ''} old`;
            } else {
                const years = Math.floor(ageInMonths / 12);
                const months = ageInMonths % 12;
                let ageText = `Age: ${years} year${years !== 1 ? 's' : ''}`;
                if (months > 0) {
                    ageText += `, ${months} month${months !== 1 ? 's' : ''}`;
                }
                ageText += ' old';
                document.getElementById('ageDisplay').textContent = ageText;
            }
        }

        // Vaccination history options
        function toggleVaccinationSections() {
            const fileUploadSection = document.getElementById('fileUploadSection');
            const manualEntrySection = document.getElementById('manualEntrySection');
            
            // Hide both sections first
            fileUploadSection.style.display = 'none';
            manualEntrySection.style.display = 'none';
            
            // Show relevant section based on selection
            if (selectedVaccinationOption === 'has-records') {
                fileUploadSection.style.display = 'block';
                manualEntrySection.style.display = 'block';
            }
        }

        // File upload functionality
        function setupFileUpload() {
            const fileUploadArea = document.getElementById('fileUploadArea');
            const fileInput = document.getElementById('vaccinationFiles');
            
            // Drag and drop functionality
            fileUploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('drag-over');
            });
            
            fileUploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
            });
            
            fileUploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                
                const files = e.dataTransfer.files;
                handleFileSelection(files);
            });
            
            fileInput.addEventListener('change', function(e) {
                handleFileSelection(e.target.files);
            });
        }

        function handleFileSelection(files) {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';
            
            Array.from(files).forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded';
                fileItem.innerHTML = `
                    <span><i class="fas fa-file me-2"></i>${file.name} (${formatFileSize(file.size)})</span>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                fileList.appendChild(fileItem);
            });
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function removeFile(index) {
            // Remove file from display and file input
            const fileList = document.getElementById('fileList');
            const fileItems = fileList.querySelectorAll('.file-item');
            if (fileItems[index]) {
                fileItems[index].remove();
            }
        }

        // Emergency contacts
        function addEmergencyContact() {
            emergencyContactCount++;
            const container = document.getElementById('emergencyContactsContainer');
            
            const contactCard = document.createElement('div');
            contactCard.className = 'contact-card';
            contactCard.innerHTML = `
                <div class="contact-header">
                    <span class="contact-title">Emergency Contact ${emergencyContactCount}</span>
                    <button type="button" class="remove-contact" onclick="removeEmergencyContact(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Full Name <span class="required">*</span></label>
                            <input type="text" class="form-control" placeholder="Contact Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone Number <span class="required">*</span></label>
                            <input type="tel" class="form-control" placeholder="(555) 123-4567" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Relationship to Child</label>
                            <select class="form-control form-select">
                                <option value="">Select Relationship</option>
                                <option value="parent">Parent</option>
                                <option value="grandparent">Grandparent</option>
                                <option value="sibling">Sibling</option>
                                <option value="aunt-uncle">Aunt/Uncle</option>
                                <option value="family-friend">Family Friend</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="contact@email.com">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" placeholder="Full address">
                </div>
            `;
            
            container.appendChild(contactCard);
        }

        function removeEmergencyContact(button) {
            button.closest('.contact-card').remove();
        }

        // Summary population
        function populateSummary() {
            document.getElementById('summaryName').textContent = 
                `${document.getElementById('firstName').value} ${document.getElementById('lastName').value}`;
            
            document.getElementById('summaryDOB').textContent = 
                document.getElementById('dateOfBirth').value;
            
            document.getElementById('summaryAge').textContent = 
                document.getElementById('ageDisplay').textContent.replace('Age: ', '');
            
            document.getElementById('summaryDoctor').textContent = 
                document.getElementById('primaryDoctor').value || 'Not specified';
            
            const contactCount = document.querySelectorAll('.contact-card').length;
            document.getElementById('summaryContacts').textContent = 
                `${contactCount} contact${contactCount !== 1 ? 's' : ''} added`;
        }

        // Notification system
        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'error' ? 'danger' : type} position-fixed`;
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
                    <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : 'check-circle'} me-2"></i>
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
    </script>
</body>
</html>
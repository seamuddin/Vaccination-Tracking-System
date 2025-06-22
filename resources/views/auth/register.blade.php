<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - VaxTracker</title>
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
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
        }

        .container-xxl {
            max-width: 1440px;
            margin: 0 auto;
        }

        .authentication-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        .authentication-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300"><path d="M0,160L48,144C96,128,192,96,288,106.7C384,117,480,171,576,186.7C672,203,768,181,864,154.7C960,128,1056,96,1152,90.7C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            background-size: 1000px 300px;
            opacity: 0.3;
        }

        .authentication-inner {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 2;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .card-body {
            padding: 3rem;
        }

        /* Logo Section */
        .app-brand {
            margin-bottom: 2rem;
            text-align: center;
        }

        .app-brand-link {
            text-decoration: none;
            display: inline-block;
        }

        .navbar-brand h2 {
            color: var(--primary-color) !important;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-brand h2 i {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Page Title */
        .page-title {
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .page-title h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Form Elements */
        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .required-star::after {
            content: ' *';
            color: var(--danger-color);
        }

        .form-control {
            border: 2px solid var(--border-light);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .form-control.is-valid {
            border-color: var(--success-color);
        }

        /* Password Toggle */
        .form-password-toggle .input-group {
            position: relative;
        }

        .input-group-text {
            background: transparent;
            border: 2px solid var(--border-light);
            border-left: none;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-control:focus + .input-group-text {
            border-color: var(--primary-color);
        }

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-meter {
            height: 4px;
            background: var(--border-light);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .strength-meter-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: var(--danger-color); }
        .strength-medium { background: var(--warning-color); }
        .strength-strong { background: var(--success-color); }

        .strength-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Error Messages */
        .help-block {
            color: var(--danger-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        .has-error .form-control {
            border-color: var(--danger-color);
        }

        /* Terms and Conditions */
        .form-check {
            margin: 1.5rem 0;
        }

        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            border: 2px solid var(--border-light);
            border-radius: 4px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            margin-left: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .form-check-label a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
            background: linear-gradient(135deg, var(--primary-hover), var(--secondary-color));
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Loading State */
        .btn-loading {
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
            to { transform: rotate(360deg); }
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-light);
        }

        .login-link p {
            color: var(--text-secondary);
            margin: 0;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Social Login (if needed in future) */
        .social-login {
            margin: 2rem 0;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--border-light);
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .authentication-wrapper {
                padding: 1rem;
            }

            .card-body {
                padding: 2rem 1.5rem;
            }

            .navbar-brand h2 {
                font-size: 1.5rem;
            }

            .page-title h3 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .card-body {
                padding: 1.5rem 1rem;
            }
        }

        /* Success Messages */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .alert-info {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
            border-left: 4px solid var(--primary-color);
        }

        /* Form Groups */
        .mb-3 {
            margin-bottom: 1.5rem;
        }

        /* Input Icons */
        .input-icon {
            position: relative;
        }

        .input-icon .form-control {
            padding-left: 2.75rem;
        }

        .input-icon .icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* Validation Icons */
        .validation-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
        }

        .validation-icon.valid {
            color: var(--success-color);
        }

        .validation-icon.invalid {
            color: var(--danger-color);
        }

        .toggle-icon{
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-secondary);
            border: none;
            background: transparent;
        }
    </style>
</head>
<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Registration -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <div class="navbar-brand d-flex align-items-center px-4 px-lg-5">
                                    <h2 class="m-0 text-primary">
                                        <i class="fas fa-syringe me-2"></i>VaxTracker
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <!-- /Logo -->

                        <!-- Page Title -->
                        <div class="page-title">
                            <h3>Create Your Account</h3>
                            <p class="page-subtitle">Join VaxTracker to keep your family healthy and protected</p>
                        </div>

                        <!-- Registration Form -->
                        <form action="{{ route('register.store') }}" method="post" id="registrationForm" enctype="multipart/form-data" role="form">
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="mb-3">
                                <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name" class="form-label required-star">Full Name</label>
                                    <div class="input-icon position-relative">
                                        <i class="fas fa-user icon"></i>
                                        <input type="text" 
                                               class="form-control required {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                               id="name"
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               placeholder="Enter your full name" 
                                               autofocus>
                                        <div class="validation-icon" id="nameValidation"></div>
                                    </div>
                                    @if($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email" class="form-label required-star">Email Address</label>
                                    <div class="input-icon position-relative">
                                        <i class="fas fa-envelope icon"></i>
                                        <input type="email" 
                                               class="form-control required {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                               id="email"
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="Enter your email address">
                                        <div class="validation-icon" id="emailValidation"></div>
                                    </div>
                                    @if($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3 form-password-toggle {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="form-label required-star">Password</label>
                                <div class="input-group position-relative">
                                    <div class="input-icon w-100">
                                        <i class="fas fa-lock icon"></i>
                                        <input type="password" 
                                               class="form-control required {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                               id="password"
                                               name="password" 
                                               placeholder="Create a strong password"
                                               style="padding-left: 2.75rem; padding-right: 3rem;">
                                    </div>
                                    <span class="input-group-text toggle-icon cursor-pointer" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                    </span>
                                </div>
                                
                                <!-- Password Strength Indicator -->
                                <div class="password-strength">
                                    <div class="strength-meter">
                                        <div class="strength-meter-fill" id="strengthMeter"></div>
                                    </div>
                                    <div class="strength-text" id="strengthText">
                                        Password must contain at least 8 characters, including uppercase, lowercase, and numbers
                                    </div>
                                </div>
                                
                                @if($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-3 form-password-toggle {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="password_confirmation" class="form-label required-star">Confirm Password</label>
                                <div class="input-group position-relative">
                                    <div class="input-icon w-100">
                                        <i class="fas fa-lock icon"></i>
                                        <input type="password" 
                                               class="form-control required {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" 
                                               id="password_confirmation"
                                               name="password_confirmation" 
                                               placeholder="Confirm your password"
                                               style="padding-left: 2.75rem; padding-right: 3rem;">
                                    </div>
                                    <span class="input-group-text toggle-icon cursor-pointer" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="togglePassword_confirmationIcon"></i>
                                    </span>
                                    <div class="pl-2 validation-icon" id="confirmPasswordValidation"></div>
                                </div>
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="/terms" target="_blank">Terms of Service</a> and 
                                        <a href="/privacy" target="_blank">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Newsletter Subscription -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" checked>
                                    <label class="form-check-label" for="newsletter">
                                        Send me helpful vaccination reminders and health tips via email
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" id="submitBtn">
                                    Create Account
                                </button>
                            </div>
                        </form>

                        <!-- Login Link -->
                        <div class="login-link">
                            <p>
                                Already have an account?
                                <a href="{{ route('login') }}">Sign in here</a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /Registration -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form validation and enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');

            // Real-time validation
            nameInput.addEventListener('input', validateName);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePasswordConfirmation);

            // Form submission
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading state
                submitBtn.classList.add('btn-loading');
                submitBtn.innerHTML = '<span class="spinner"></span>Creating Account...';
                submitBtn.disabled = true;
            });

            function validateName() {
                const value = nameInput.value.trim();
                const validation = document.getElementById('nameValidation');
                
                if (value.length < 2) {
                    setValidationState(nameInput, validation, false, 'Name must be at least 2 characters');
                    return false;
                } else if (value.length > 50) {
                    setValidationState(nameInput, validation, false, 'Name must be less than 50 characters');
                    return false;
                } else {
                    setValidationState(nameInput, validation, true, 'Valid name');
                    return true;
                }
            }

            function validateEmail() {
                const value = emailInput.value.trim();
                const validation = document.getElementById('emailValidation');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (!emailRegex.test(value)) {
                    setValidationState(emailInput, validation, false, 'Please enter a valid email address');
                    return false;
                } else {
                    setValidationState(emailInput, validation, true, 'Valid email address');
                    return true;
                }
            }

            function validatePassword() {
                const value = passwordInput.value;
                const strengthMeter = document.getElementById('strengthMeter');
                const strengthText = document.getElementById('strengthText');
                
                let strength = 0;
                let feedback = [];

                // Length check
                if (value.length >= 8) {
                    strength += 1;
                } else {
                    feedback.push('at least 8 characters');
                }

                // Uppercase check
                if (/[A-Z]/.test(value)) {
                    strength += 1;
                } else {
                    feedback.push('uppercase letter');
                }

                // Lowercase check
                if (/[a-z]/.test(value)) {
                    strength += 1;
                } else {
                    feedback.push('lowercase letter');
                }

                // Number check
                if (/\d/.test(value)) {
                    strength += 1;
                } else {
                    feedback.push('number');
                }

                // Special character check
                if (/[^A-Za-z0-9]/.test(value)) {
                    strength += 1;
                }

                // Update strength meter
                const percentage = (strength / 5) * 100;
                strengthMeter.style.width = percentage + '%';
                
                if (strength <= 2) {
                    strengthMeter.className = 'strength-meter-fill strength-weak';
                    strengthText.textContent = 'Weak password. Add: ' + feedback.join(', ');
                    strengthText.style.color = 'var(--danger-color)';
                } else if (strength <= 3) {
                    strengthMeter.className = 'strength-meter-fill strength-medium';
                    strengthText.textContent = 'Medium strength. Consider adding: ' + feedback.join(', ');
                    strengthText.style.color = 'var(--warning-color)';
                } else {
                    strengthMeter.className = 'strength-meter-fill strength-strong';
                    strengthText.textContent = 'Strong password!';
                    strengthText.style.color = 'var(--success-color)';
                }
                
                var confirmPassword = confirmPasswordInput.value;
                var validation = document.getElementById('confirmPasswordValidation');

                if (confirmPassword !== password) {
                    setValidationState(confirmPasswordInput, validation, false, 'Passwords do not match');
                } else if (confirmPassword.length > 0) {
                    setValidationState(confirmPasswordInput, validation, true, 'Passwords match');
                }
                
                return strength >= 3;



            }

            function validatePasswordConfirmation() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                const validation = document.getElementById('confirmPasswordValidation');
                
                if (confirmPassword !== password) {
                    setValidationState(confirmPasswordInput, validation, false, 'Passwords do not match');
                    return false;
                } else if (confirmPassword.length > 0) {
                    setValidationState(confirmPasswordInput, validation, true, 'Passwords match');
                    return true;
                }
                return false;
            }

            function setValidationState(input, validationIcon, isValid, message) {
                if (isValid) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    
                    validationIcon.title = message;
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    
                    validationIcon.title = message;
                }
            }

            function validateForm() {
                const nameValid = validateName();
                const emailValid = validateEmail();
                const passwordValid = validatePassword();
                const confirmPasswordValid = validatePasswordConfirmation();
                const termsChecked = document.getElementById('terms').checked;

                if (!termsChecked) {
                    alert('Please accept the Terms of Service and Privacy Policy');
                    return false;
                }

                return nameValid && emailValid && passwordValid && confirmPasswordValid;
            }
        });

        // Password toggle functionality
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById('toggle' + fieldId.charAt(0).toUpperCase() + fieldId.slice(1) + 'Icon');
            console.log('toggle' + fieldId.charAt(0).toUpperCase() + fieldId.slice(1) + 'Icon');


            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Real-time email availability check (optional)
        let emailTimeout;
        document.getElementById('email').addEventListener('input', function() {
            clearTimeout(emailTimeout);
            emailTimeout = setTimeout(checkEmailAvailability, 500);
        });

        function checkEmailAvailability() {
            const email = document.getElementById('email').value;
            if (email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                // In real implementation, make AJAX call to check email availability
                console.log('Checking email availability for:', email);
            }
        }

        // Auto-focus management
        document.addEventListener('DOMContentLoaded', function() {
            // Focus on first empty required field
            const requiredFields = document.querySelectorAll('.required');
            for (let field of requiredFields) {
                if (!field.value) {
                    field.focus();
                    break;
                }
            }
        });
    </script>
</body>
</html>
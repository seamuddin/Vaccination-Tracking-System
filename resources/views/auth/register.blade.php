@extends('frontend.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/registration.css') }}">
@endsection
@section('content')
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
@endsection

@section('scripts')
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

@endsection
@extends('frontend.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endsection
@section('content')
    <!-- Government Header -->
    <header class="gov-header">
        <div class="container">
            <div class="gov-logo-section row align-items-center">
                <div class="col-12 col-md-10 d-flex flex-column flex-md-row align-items-center">
                    <span class="emblem-placeholder me-2 mb-4 mb-md-0 text-center text-md-start">
                        <!-- Placeholder for Bangladesh National Emblem -->
                        <i class="fas fa-shield-alt"></i>
                    </span>
                    <div class="gov-title text-center text-md-start">
                        <h1 class="bangla-text mb-1">স্বাস্থ্য অধিদপ্তর – টিকা ট্র্যাকিং সিস্টেম</h1>
                        <p class="english-text mb-0">Directorate General of Health Services – Vaccination Tracking System</p>
                    </div>
                </div>
                <div class="gov-badge col-12 col-md-2 text-center mt-2 mt-md-0">
                    <a href="/" class="bangla-text ">
                        <i class="fas fa-certificate me-1"></i>
                    <span class="bangla-text">সরকারি পোর্টাল</span>
                    </a>
                </div>
            </div>
            
           
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-container">
        <!-- Left Side - Image Section -->
        <div class="image-section d-none d-md-flex">            
            <div class="vaccination-illustration">
            <div class="main-visual">
                <img height='180' src="{{ asset('assets/img/vaccine-vector2.png') }}" alt="">
            </div>
            
                <div class="illustration-title">
                    <h2 class="bangla-text">সুরক্ষিত টিকাদান</h2>
                    <p class="bangla-text">আপনার সন্তানের ভবিষ্যত সুরক্ষিত করুন আমাদের সম্পূর্ণ টিকা ট্র্যাকিং ও ব্যবস্থাপনা সিস্টেমের মাধ্যমে।</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="form-section">
            <div class="login-form-container">
                <div class="login-card">
                    <!-- Card Header -->
                    

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Security Notice -->

                        <!-- Login Form (Laravel Collective) -->
                        {!! Form::open(['route' => 'login.check','method' => 'post','id' => 'form_id','enctype' => 'multipart/form-data','files' => 'true','role' => 'form']) !!}
                        <div class="mb-3">
                            <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
                                {!! Form::label('email', 'ইমেইল ঠিকানা', ['class'=>'col-md-12 form-label bangla-text required-star']) !!}
                                <div class="col-md-12">
                                    {!! Form::text('email', old('email'), ['class' => 'form-control required english-text', 'placeholder' => 'Enter your email', 'autofocus'=>'true']) !!}
                                    {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle {{ $errors->has('password') ? 'has-error' : '' }}">
                            <div class="d-flex justify-content-between">
                                {!! Form::label('password', 'পাসওয়ার্ড', ['class'=>'form-label bangla-text required-star']) !!}
                               
                            </div>
                            <div class="col-md-12" style="position: relative;">
                                {!! Form::password('password', ['class' => 'form-control required english-text', 'placeholder' => 'Enter your password']) !!}
                                <span class="input-group-text cursor-pointer" style="position:absolute; top:3px; right:0px"><i class="bx bx-hide"></i></span>
                            </div>
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember-me"/>
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-login d-grid w-100" type="submit">
                                <span class="login-text bangla-text">
                                    <i class="fas fa-sign-in-alt me-2"></i>প্রবেশ করুন
                                </span>
                            </button>
                        </div>
                        {!! Form::close() !!}

                        <!-- Secondary Actions -->
                        <div class="secondary-actions">
                            <a href="#" class="register-link bangla-text" onclick="showRegistration()">
                                <i class="fas fa-user-plus me-2"></i>নতুন অ্যাকাউন্ট তৈরি করুন
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="gov-footer">
        <div class="container">
            <div class="footer-links">
                <a href="#" onclick="showPrivacy()" class="bangla-text">গোপনীয়তা নীতি</a>
                <a href="#" onclick="showContact()" class="bangla-text">যোগাযোগ</a>
                <a href="#" onclick="showHelp()" class="bangla-text">সাহায্য</a>
                <a href="#" onclick="showTerms()" class="english-text">Terms of Service</a>
            </div>
            <div class="footer-info bangla-text">
                © ২০২৫ স্বাস্থ্য অধিদপ্তর, গণপ্রজাতন্ত্রী বাংলাদেশ সরকার। সকল অধিকার সংরক্ষিত।
            </div>
        </div>
    </footer>

@endsection

@section('scripts')
   <script>
        // Handle login form submission
        function handleLogin(event) {
            event.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const loginBtn = document.getElementById('loginBtn');
            const loginText = loginBtn.querySelector('.login-text');
            const loadingText = loginBtn.querySelector('.loading');
            
            // Validate inputs
            if (!email || !password) {
                showAlert('সকল ক্ষেত্র পূরণ করুন', 'error');
                return;
            }

            // Validate email format
            if (!validateEmail(email)) {
                showAlert('সঠিক ইমেইল ঠিকানা দিন', 'error');
                return;
            }

            // Show loading state
            loginText.classList.add('d-none');
            loadingText.classList.remove('d-none');
            loginBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Reset button state
                loginText.classList.remove('d-none');
                loadingText.classList.add('d-none');
                loginBtn.disabled = false;

                // Show success and redirect
                showAlert('সফলভাবে প্রবেশ করেছেন! টিকা ট্র্যাকিং ড্যাশবোর্ডে পুনর্নির্দেশ করা হচ্ছে...', 'success');
                
                // In real app, redirect to dashboard
                setTimeout(() => {
                    console.log('Redirecting to vaccination tracking dashboard...');
                    // window.location.href = '/dashboard';
                }, 2000);
            }, 2500);
        }

        // Email validation function
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Helper functions
        function forgotPassword() {
            showAlert('পাসওয়ার্ড রিসেট লিংক আপনার নিবন্ধিত মোবাইল নম্বরে পাঠানো হবে।', 'info');
        }

        function showRegistration() {
            showAlert('নতুন অ্যাকাউন্ট তৈরির পৃষ্ঠা খোলা হবে।', 'info');
        }

        function showHelp() {
            showAlert('সাহায্য কেন্দ্র খোলা হবে। হটলাইন: ১৬২৬৩', 'info');
        }

        function showPrivacy() {
            showAlert('গোপনীয়তা নীতি পৃষ্ঠা খোলা হবে।', 'info');
        }

        function showContact() {
            showAlert('যোগাযোগ তথ্য: ০২-৯৬৬৬৭৭৮ | info@dghs.gov.bd', 'info');
        }

        function showTerms() {
            showAlert('Terms of Service page would open.', 'info');
        }

        // Language toggle
        let currentLang = 'bn';
        function toggleLanguage() {
            const langText = document.getElementById('langText');
            if (currentLang === 'bn') {
                langText.textContent = 'বাংলা';
                currentLang = 'en';
                showAlert('Language switched to English', 'info');
            } else {
                langText.textContent = 'English';
                currentLang = 'bn';
                showAlert('ভাষা বাংলায় পরিবর্তিত হয়েছে', 'info');
            }
        }

        // Alert system
        function showAlert(message, type = 'info') {
            const existingAlert = document.querySelector('.custom-alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            const alertColors = {
                success: 'var(--bd-green)',
                error: 'var(--bd-red)',
                warning: 'var(--warning-color)',
                info: 'var(--gov-blue)'
            };

            const alertIcons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };

            const alert = document.createElement('div');
            alert.className = 'custom-alert';
            alert.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: ${alertColors[type]};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: var(--shadow-medium);
                z-index: 9999;
                display: flex;
                align-items: center;
                font-weight: 500;
                max-width: 90%;
                animation: slideDown 0.3s ease-out;
            `;

            alert.innerHTML = `
                <i class="${alertIcons[type]} me-2"></i>
                ${message}
            `;

            document.body.appendChild(alert);

            setTimeout(() => {
                alert.style.animation = 'slideUp 0.3s ease-out forwards';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.remove();
                    }
                }, 300);
            }, 4000);
        }

        // Add slide animations for alerts
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateX(-50%) translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
            }
            
            @keyframes slideUp {
                from {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(-50%) translateY(-20px);
                }
            }
        `;
        document.head.appendChild(style);

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            // Email validation
            emailInput.addEventListener('blur', function() {
                if (this.value && !validateEmail(this.value)) {
                    this.style.borderColor = 'var(--bd-red)';
                } else {
                    this.style.borderColor = 'var(--border-light)';
                }
            });

            // Password validation
            passwordInput.addEventListener('blur', function() {
                if (this.value && this.value.length < 6) {
                    this.style.borderColor = 'var(--bd-red)';
                    showAlert('পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে', 'error');
                } else {
                    this.style.borderColor = 'var(--border-light)';
                }
            });

            // Reset border on focus
            [emailInput, passwordInput].forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--bd-green)';
                });
            });
        });

    </script>
@endsection
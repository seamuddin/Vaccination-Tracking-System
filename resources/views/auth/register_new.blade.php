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
                    <div class="card-header text-center">
                        <h3 class="bangla-text fw-bold mb-0">
                            অভিভাবক নিবন্ধন
                        </h3>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <!-- Security Notice -->
                        

                    <div class="main-form">
                        <!-- Registration Form (Laravel Collective) -->
                        {!! Form::open(['route' => 'register.store','method' => 'post','id' => 'registration_form','enctype' => 'multipart/form-data','files' => true,'role' => 'form']) !!}

                        <div class="mb-3">
                            {!! Form::label('name', 'পূর্ণ নাম', ['class'=>'form-label bangla-text required-star']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control required bangla-text','id' =>'name', 'placeholder' => 'আপনার পূর্ণ নাম লিখুন', 'autofocus'=>'true', 'required' => true]) !!}
                            {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="mb-3">
                            {!! Form::label('email', 'ইমেইল', ['class'=>'form-label bangla-text required-star']) !!}
                            {!! Form::email('email', old('email'), ['class' => 'form-control required english-text','id' =>'email', 'placeholder' => 'আপনার ইমেইল লিখুন', 'required' => true]) !!}
                            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="mb-3">
                            {!! Form::label('password', 'পাসওয়ার্ড', ['class'=>'form-label bangla-text required-star']) !!}
                            <div class="input-group">
                                {!! Form::password('password', ['class' => 'form-control required english-text', 'id'=>'password','placeholder' => 'পাসওয়ার্ড দিন', 'required' => true]) !!}
                                <span class="input-group-text cursor-pointer" onclick="togglePassword('password')"><i class="bx bx-hide"></i></span>
                            </div>
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="mb-3">
                            {!! Form::label('password_confirmation', 'পাসওয়ার্ড নিশ্চিত করুন', ['class'=>'form-label bangla-text required-star']) !!}
                            <div class="input-group">
                                {!! Form::password('password_confirmation', ['class' => 'form-control required english-text', 'id'=>'password_confirmation','placeholder' => 'পুনরায় পাসওয়ার্ড দিন', 'required' => true]) !!}
                                <span class="input-group-text cursor-pointer" onclick="togglePassword('password_confirmation')"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('nid', 'জাতীয় পরিচয়পত্র নম্বর', ['class'=>'form-label bangla-text required-star']) !!}
                            {!! Form::number('nid', old('nid'), [
                                'class' => 'form-control required bangla-text',
                                'id' => 'nid',
                                'placeholder' => 'NID নম্বর',
                                'required' => true,
                                'min' => 0,
                                'step' => 1,
                                'inputmode' => 'numeric',
                                'pattern' => '[0-9]*'
                            ]) !!}
                            {!! $errors->first('nid','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="mb-3">
                            {!! Form::label('mobile', 'মোবাইল নম্বর', ['class'=>'form-label bangla-text required-star']) !!}
                            {!! Form::text('mobile', old('mobile'), ['class' => 'form-control required bangla-text','id' =>'mobile_number', 'placeholder' => 'মোবাইল নম্বর লিখুন', 'required' => true]) !!}
                            {!! $errors->first('mobile','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                        
                       <div class="form-footer">
                            <div class="mb-3 form-check pt-2">
                                {!! Form::checkbox('agree', 1, false, ['class' => 'form-check-input', 'id' => 'agree']) !!}
                                {!! Form::label('agree', 'আমি গোপনীয়তা নীতি ও শর্তাবলীতে সম্মত', ['class'=>'form-check-label bangla-text required-star']) !!}
                                {!! $errors->first('agree','<span class="help-block">:message</span>') !!}
                            </div>
                    
                        <div class="mb-3">
                            <button class="btn btn-login d-grid w-100" type="submit">
                                <span class="login-text bangla-text">
                                    <i class="fas fa-sign-in-alt me-2"></i>নিবন্ধন করুন
                                </span>
                            </button>
                        </div>
                        {!! Form::close() !!}

                        <!-- Secondary Actions -->
                        <div class="secondary-actions pt-2">
                            <a href="{{ route('login') }}" class="login-link bangla-text">
                                <i class="fas fa-sign-in-alt me-2"></i>ইতিমধ্যে অ্যাকাউন্ট আছে? প্রবেশ করুন
                            </a>
                        </div>
                       </div>
                    </div>
                    <script>
                        function togglePassword(fieldId) {
                            const input = document.getElementById(fieldId);
                            if (input.type === "password") {
                                input.type = "text";
                            } else {
                                input.type = "password";
                            }
                        }
                    </script>
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
            

            // Reset border on focus
            [emailInput, passwordInput].forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--bd-green)';
                });
            });
        });

    </script>
@endsection
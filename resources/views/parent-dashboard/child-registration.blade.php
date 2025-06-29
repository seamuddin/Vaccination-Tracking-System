@extends('parent-dashboard.index')
@section('title')
    Parent Dashboard - VaxTracker
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/child-registration.css') }}">
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    

    <!-- Main Dashboard -->
    <div class="main-container">
        <div class="container">
            <!-- Page Title -->
            <div class="page-title">
                <h2 class="mb-4 text-center">Register New Child</h2>
                <p class="page-subtitle">Add a new child to the vaccination tracking system</p>
            </div>

            <!-- Info Box -->
            <div class="info-box mx-auto" style="max-width: 500px;">
                <h6><i class="fas fa-info-circle me-2"></i>What happens after registration?</h6>
                <p>Once registered, the system will automatically generate a complete vaccination schedule based on the child's age and current vaccination guidelines.</p>
            </div>

            <!-- Success Message -->
            <div class="success-message mx-auto" style="max-width: 500px;" id="successMessage">
                <i class="fas fa-check-circle"></i>
                <span id="successText">Child registered successfully! Vaccination schedule has been generated.</span>
            </div>

            <!-- Error Message -->
            <div class="error-message mx-auto" style="max-width: 500px;" id="errorMessage">
                <i class="fas fa-exclamation-triangle"></i>
                <span id="errorText">Please check the form for errors and try again.</span>
            </div>

            <!-- Registration Form -->
            <div class="card shadow-sm p-4 mx-auto fade-in" style="max-width: 500px;">
                <form action="{{ route('child.register.store') }}" method="POST" id="child-registration-form" class="child-registration-form">
                    @csrf
                    
                    <!-- Child's Name -->
                    <div class="form-group mb-3">
                        <label for="child_name" class="form-label required">Child's Name</label>
                        <input type="text" 
                               id="child_name" 
                               name="child_name" 
                               class="form-control" 
                               required 
                               placeholder="Enter child's full name"
                               value="{{ old('child_name') }}">
                        <div class="validation-icon" id="nameValidation"></div>
                        @error('child_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group mb-3">
                        <label for="dob" class="form-label required">Date of Birth</label>
                        <input type="date" 
                               id="dob" 
                               name="dob" 
                               class="form-control" 
                               required
                               value="{{ old('dob') }}"
                               max="{{ date('Y-m-d') }}">
                        <div class="validation-icon" id="dobValidation"></div>
                        <div class="age-display" id="ageDisplay" style="display: none;">
                            <i class="fas fa-birthday-cake me-2"></i>
                            <span id="ageText"></span>
                        </div>
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="form-group mb-4">
                        <label for="gender" class="form-label required">Gender</label>
                        <select id="gender" 
                                name="gender" 
                                class="form-control select2" 
                                required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <div class="validation-icon" id="genderValidation"></div>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between form-actions">
                        <button type="reset" class="btn btn-outline-secondary" id="reset_button">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitButton">
                            <i class="fas fa-user-plus me-2"></i>Register Child
                        </button>
                    </div>
                </form>
            </div>

            <!-- Next Steps Info -->
            <div class="info-box mx-auto mt-4" style="max-width: 500px;">
                <h6><i class="fas fa-calendar-check me-2"></i>Next Steps</h6>
                <p>After registration, you can view the child's profile and vaccination schedule from the Children management section.</p>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
         <script type="text/javascript" src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>

     <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: 'Select Gender',
                allowClear: true,
                width: '100%'
            });

            // Form validation and enhancement
            const form = $('#child-registration-form');
            const nameInput = $('#child_name');
            const dobInput = $('#dob');
            const genderSelect = $('#gender');
            const submitButton = $('#submitButton');
            const resetButton = $('#reset_button');

            // Real-time validation
            nameInput.on('input', validateName);
            dobInput.on('change', validateDOB);
            genderSelect.on('change', validateGender);

            // Calculate and display age when DOB changes
            dobInput.on('change', calculateAge);

            // Form submission
            form.on('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    showErrorMessage('Please correct the errors in the form.');
                    return false;
                }
                
                // Show loading state
                submitButton.addClass('btn-loading');
                submitButton.html('<span class="spinner"></span>Registering...');
                submitButton.prop('disabled', true);
            });

            // Reset form
            resetButton.on('click', function() {
                form[0].reset();
                $('.select2').val(null).trigger('change');
                clearValidation();
                hideMessages();
                $('#ageDisplay').hide();
            });

            function validateName() {
                const value = nameInput.val().trim();
                const validation = $('#nameValidation');
                
                if (value.length < 2) {
                    setValidationState(nameInput, validation, false);
                    return false;
                } else if (value.length > 100) {
                    setValidationState(nameInput, validation, false);
                    return false;
                } else if (!/^[a-zA-Z\s'-]+$/.test(value)) {
                    setValidationState(nameInput, validation, false);
                    return false;
                } else {
                    setValidationState(nameInput, validation, true);
                    return true;
                }
            }

            function validateDOB() {
                const value = dobInput.val();
                const validation = $('#dobValidation');
                
                if (!value) {
                    setValidationState(dobInput, validation, false);
                    return false;
                }
                
                const birthDate = new Date(value);
                const today = new Date();
                
                if (birthDate > today) {
                    setValidationState(dobInput, validation, false);
                    return false;
                } else {
                    setValidationState(dobInput, validation, true);
                    return true;
                }
            }

            function validateGender() {
                const value = genderSelect.val();
                const validation = $('#genderValidation');
                
                if (!value) {
                    setValidationState(genderSelect, validation, false);
                    return false;
                } else {
                    setValidationState(genderSelect, validation, true);
                    return true;
                }
            }

            function calculateAge() {
                const birthDate = new Date(dobInput.val());
                const today = new Date();
                const ageDisplay = $('#ageDisplay');
                const ageText = $('#ageText');
                
                if (!dobInput.val() || birthDate > today) {
                    ageDisplay.hide();
                    return;
                }
                
                const ageInMonths = (today.getFullYear() - birthDate.getFullYear()) * 12 + 
                                   (today.getMonth() - birthDate.getMonth());
                
                let ageString = '';
                if (ageInMonths < 1) {
                    const ageInDays = Math.floor((today - birthDate) / (1000 * 60 * 60 * 24));
                    ageString = `${ageInDays} day${ageInDays !== 1 ? 's' : ''} old`;
                } else if (ageInMonths < 12) {
                    ageString = `${ageInMonths} month${ageInMonths !== 1 ? 's' : ''} old`;
                } else {
                    const years = Math.floor(ageInMonths / 12);
                    const months = ageInMonths % 12;
                    ageString = `${years} year${years !== 1 ? 's' : ''}`;
                    if (months > 0) {
                        ageString += `, ${months} month${months !== 1 ? 's' : ''}`;
                    }
                    ageString += ' old';
                }
                
                ageText.text(`Age: ${ageString}`);
                ageDisplay.show().addClass('visible');
            }

            function setValidationState(input, validationIcon, isValid) {
                if (isValid) {
                    input.removeClass('is-invalid').addClass('is-valid');
                    validationIcon.html('<i class="fas fa-check valid"></i>');
                } else {
                    input.removeClass('is-valid').addClass('is-invalid');
                    validationIcon.html('<i class="fas fa-times invalid"></i>');
                }
            }

            function validateForm() {
                const nameValid = validateName();
                const dobValid = validateDOB();
                const genderValid = validateGender();
                
                return nameValid && dobValid && genderValid;
            }

            function clearValidation() {
                $('input, select').removeClass('is-valid is-invalid');
                $('.validation-icon').empty();
            }

            function showSuccessMessage(message) {
                $('#successText').text(message);
                $('#successMessage').addClass('show');
                $('html, body').animate({
                    scrollTop: $('#successMessage').offset().top - 100
                }, 500);
            }

            function showErrorMessage(message) {
                $('#errorText').text(message);
                $('#errorMessage').addClass('show');
                $('html, body').animate({
                    scrollTop: $('#errorMessage').offset().top - 100
                }, 500);
            }

            function hideMessages() {
                $('#successMessage, #errorMessage').removeClass('show');
            }

            // Handle form submission success (if coming from server)
            @if(session('success'))
                showSuccessMessage('{{ session('success') }}');
                form[0].reset();
                $('.select2').val(null).trigger('change');
                clearValidation();
                $('#ageDisplay').hide();
            @endif

            // Handle form submission errors (if coming from server)
            @if($errors->any())
                showErrorMessage('Please correct the errors in the form and try again.');
            @endif

            // Auto-focus on first field
            nameInput.focus();

            // Keyboard shortcuts
            $(document).on('keydown', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key) {
                        case 'Enter':
                            e.preventDefault();
                            if (validateForm()) {
                                form.submit();
                            }
                            break;
                        case 'r':
                            e.preventDefault();
                            resetButton.click();
                            break;
                    }
                }
            });
        });
    </script>
@endsection
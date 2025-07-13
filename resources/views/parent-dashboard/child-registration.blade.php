@extends('parent-dashboard.main')
@section('header-resources')

    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/child_page.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/child-registration.css') }}">
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>

@endsection

@section('body')

<!-- Main Dashboard -->
    <div class="main-container">
        <div class="container">
            <!-- Page Title -->
            <div class="page-form-title">
                <h2 class="mb-4 text-center">Register New Child</h2>
                <p class=" text-center page-subtitle">Add a new child to the vaccination tracking system</p>
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
                {!! Form::open([
                    'route' => 'child.register.store',
                    'method' => 'post',
                    'id' => 'child-registration-form',
                    'enctype' => 'multipart/form-data',
                    'files' => true,
                    'role' => 'form',
                ]) !!}

                    <!-- Child's Name -->
                    <div class="form-group mb-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', "Child's Name", ['class' => 'form-label required']) !!}
                        {!! Form::text('name', old('name'), [
                            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                            'required' => true,
                            'placeholder' => "Enter child's full name",
                            'id' => 'child_name'
                        ]) !!}
                        <div class="validation-icon" id="nameValidation"></div>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback" style="display:block;">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group mb-3 {{ $errors->has('dob') ? 'has-error' : '' }}">
                        {!! Form::label('dob', 'Date of Birth', ['class' => 'form-label required']) !!}
                        {!! Form::date('dob', old('dob'), [
                            'class' => 'form-control' . ($errors->has('dob') ? ' is-invalid' : ''),
                            'required' => true,
                            'id' => 'dob',
                            'max' => date('Y-m-d')
                        ]) !!}
                        <div class="validation-icon" id="dobValidation"></div>
                        <div class="age-display" id="ageDisplay" style="display: none;">
                            <i class="fas fa-birthday-cake me-2"></i>
                            <span id="ageText"></span>
                        </div>
                        @if ($errors->has('dob'))
                            <div class="invalid-feedback" style="display:block;">
                                {{ $errors->first('dob') }}
                            </div>
                        @endif
                    </div>

                    <!-- Gender -->
                    <div class="form-group mb-3 {{ $errors->has('gender') ? 'has-error' : '' }}">
                        {!! Form::label('gender', 'Gender', ['class' => 'form-label required']) !!}
                        {!! Form::select('gender', [
                            '' => 'Select Gender',
                            'male' => 'Male',
                            'female' => 'Female',
                            'other' => 'Other'
                        ], old('gender'), [
                            'class' => 'form-control select2' . ($errors->has('gender') ? ' is-invalid' : ''),
                            'required' => true,
                            'id' => 'gender'
                        ]) !!}
                        <div class="validation-icon" id="genderValidation"></div>
                        @if ($errors->has('gender'))
                            <div class="invalid-feedback" style="display:block;">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                    </div>

                    <!-- Birth Certificate Number -->
                    <div class="form-group mb-3 {{ $errors->has('birth_certificate_no') ? 'has-error' : '' }}">
                        {!! Form::label('birth_certificate_no', 'Birth Certificate Number', ['class' => 'form-label required']) !!}
                        {!! Form::number('birth_certificate_no', old('birth_certificate_no'), [
                            'class' => 'form-control' . ($errors->has('birth_certificate_no') ? ' is-invalid' : ''),
                            'required' => true,
                            'placeholder' => 'Enter birth certificate number',
                            'id' => 'birth_certificate_no'
                        ]) !!}
                        @if ($errors->has('birth_certificate_no'))
                            <div class="invalid-feedback" style="display:block;">
                                {{ $errors->first('birth_certificate_no') }}
                            </div>
                        @endif
                    </div>

                    <!-- Birth Certificate File -->
                    <div class="form-group mb-4 {{ $errors->has('birth_certificate') ? 'has-error' : '' }}">
                        {!! Form::label('birth_certificate', 'Birth Certificate (Upload)', ['class' => 'form-label required']) !!}
                        {!! Form::file('birth_certificate', [
                            'class' => 'form-control' . ($errors->has('birth_certificate') ? ' is-invalid' : ''),
                            'required' => true,
                            'id' => 'birth_certificate',
                            'accept' => '.pdf,.jpg,.jpeg,.png'
                        ]) !!}
                        @if ($errors->has('birth_certificate'))
                            <div class="invalid-feedback" style="display:block;">
                                {{ $errors->first('birth_certificate') }}
                            </div>
                        @endif
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between form-actions">
                        {!! Form::button('<i class="fas fa-undo me-2"></i>Reset', [
                            'type' => 'reset',
                            'class' => 'btn btn-outline-secondary',
                            'id' => 'reset_button'
                        ]) !!}
                        {!! Form::button('<i class="fas fa-user-plus me-2"></i>Register Child', [
                            'type' => 'submit',
                            'class' => 'btn btn-primary',
                            'id' => 'submitButton'
                        ]) !!}
                    </div>
                {!! Form::close() !!}
            </div>

            <!-- Next Steps Info -->
            <div class="info-box mx-auto mt-4" style="max-width: 500px;">
                <h6><i class="fas fa-calendar-check me-2"></i>Next Steps</h6>
                <p>After registration, you can view the child's profile and vaccination schedule from the Children management section.</p>
            </div>
        </div>
    </div>

@endsection


@section('footer-script')
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


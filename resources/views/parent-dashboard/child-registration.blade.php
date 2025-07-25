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

                      <div>
                        <div class="col-md-12">
                            <div class="form-group row has-feedback">
                                <div id="browseimagepp">
                                    <div class="row">
                                        <div class="col-md-12 addImages">
                                            <label class="center-block image-upload" for="user_pic">
                                                <figure>
                                                    <img
                                                        src="{{ url('images/no_image.png') }}"
                                                        class="img-responsive img-thumbnail" id="user_pic_preview"
                                                        width="150px" height="150px">
                                                </figure>
                                                <input type="hidden" id="user_pic_base64" name="user_pic_base64" value="">
                                               
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pb-3">
                            <h4 id="profile_image">
                                <label for="user_pic" class="required-star ">Child image</label>
                            </h4>
                            <p class="text-success fw-bold small">[File Format: *.jpg/ .jpeg/ .png | Width 300PX, Height 300PX]</p>
                            <span id="user_err" class="text-danger" style="font-size: 10px;"></span>
                            <input type="file" class="form-control" name="user_pic" id="user_pic"
                                   onchange="imageUploadWithCropping(this, 'user_pic_preview', 'user_pic_base64')"
                                   size="300x300">
                        </div>
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
    @include('plugins/image_upload')

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
            

            // Calculate and display age when DOB changes
            dobInput.on('change', calculateAge);

            // Form submission
           

            // Reset form
            resetButton.on('click', function() {
                form[0].reset();
                $('.select2').val(null).trigger('change');
                $('#ageDisplay').hide();
            });

            

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

           


           

          
        });
    </script>
@endsection


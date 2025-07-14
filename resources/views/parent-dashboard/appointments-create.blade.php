@extends('parent-dashboard.main')
@section('header-resources')
    <link rel="stylesheet" href="{{ asset('assets/css/parent_dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2 { width: 100% !important; }
    </style>
@endsection

@section('body')
<div class="main-container p-5">
    <div class="container">
        <div class="page-form-title">
            <h2 class="mb-4 text-center">Create Appointment</h2>
        </div>

        <div class="card shadow-sm p-4 mx-auto fade-in" style="">
            {!! Form::open([
                'route' => 'appointments.store',
                'method' => 'post',
                'id' => 'appointment-create-form',
                'role' => 'form',
            ]) !!}

            <!-- Child -->
            <div class="form-group mb-3 {{ $errors->has('child_id') ? 'has-error' : '' }} p-3">
                {!! Form::label('child_id', "Child", ['class' => 'form-label required']) !!}
                {!! Form::select('child_id', $children, old('child_id'), [
                    'class' => 'form-control select2' . ($errors->has('child_id') ? ' is-invalid' : ''),
                    'required' => true,
                    'placeholder' => 'Select Child',
                    'id' => 'child_id'
                ]) !!}
                @if ($errors->has('child_id'))
                    <div class="invalid-feedback" style="display:block;">
                        {{ $errors->first('child_id') }}
                    </div>
                @endif
            </div>

            <!-- Vaccine -->
            <div class="form-group mb-3 {{ $errors->has('vaccine_id') ? 'has-error' : '' }}">
                {!! Form::label('vaccine_id', "Vaccine", ['class' => 'form-label required']) !!}
                {!! Form::select('vaccine_id', $vaccines, old('vaccine_id'), [
                    'class' => 'form-control select2' . ($errors->has('vaccine_id') ? ' is-invalid' : ''),
                    'required' => true,
                    'placeholder' => 'Select Vaccine',
                    'id' => 'vaccine_id'
                ]) !!}
                @if ($errors->has('vaccine_id'))
                    <div class="invalid-feedback" style="display:block;">
                        {{ $errors->first('vaccine_id') }}
                    </div>
                @endif
            </div>

            <!-- Dose -->
            <div class="form-group mb-3 {{ $errors->has('dose') ? 'has-error' : '' }}">
                {!! Form::label('dose', "Dose", ['class' => 'form-label required']) !!}
                {!! Form::select('dose', [], old('dose'), [
                    'class' => 'form-control select2' . ($errors->has('dose') ? ' is-invalid' : ''),
                    'required' => true,
                    'placeholder' => 'Select Dose',
                    'id' => 'dose'
                ]) !!}
                @if ($errors->has('dose'))
                    <div class="invalid-feedback" style="display:block;">
                        {{ $errors->first('dose') }}
                    </div>
                @endif
            </div>
            <script>
                $(document).ready(function() {
                    $('#vaccine_id').on('change', function() {
                        var vaccineId = $(this).val();
                        $('#dose').empty().append('<option value="">Loading...</option>');
                        if (vaccineId) {
                            $.ajax({
                                url: '{{ route("doses.byVaccine") }}',
                                type: 'GET',
                                data: { vaccine_id: vaccineId },
                                success: function(data) {
                                    $('#dose').empty().append('<option value="">Select Dose</option>');
                                    $.each(data, function(key, value) {
                                        $('#dose').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                    $('#dose').trigger('change');
                                },
                                error: function() {
                                    $('#dose').empty().append('<option value="">No doses found</option>');
                                }
                            });
                        } else {
                            $('#dose').empty().append('<option value="">Select Dose</option>');
                        }
                    });

                    if ($('#vaccine_id').val()) {
                        $('#vaccine_id').trigger('change');
                    }

                    var oldDose = '{{ old('dose') }}';
                    if (oldDose) {
                        // Wait for AJAX to finish and options to be populated
                        var setDoseInterval = setInterval(function() {
                            if ($('#dose option').length > 1) {
                                $('#dose').val(oldDose).trigger('change');
                                clearInterval(setDoseInterval);
                            }
                        }, 100);
                    }
                });
            </script>

            <!-- Vaccine Center -->
            <div class="form-group mb-3 {{ $errors->has('vaccine_center_id') ? 'has-error' : '' }}">
                {!! Form::label('vaccine_center_id', "Vaccine Center", ['class' => 'form-label required']) !!}
                {!! Form::select('vaccine_center_id', $vaccineCenters, old('vaccine_center_id'), [
                    'class' => 'form-control select2' . ($errors->has('vaccine_center_id') ? ' is-invalid' : ''),
                    'required' => true,
                    'placeholder' => 'Select Center',
                    'id' => 'vaccine_center_id'
                ]) !!}
                @if ($errors->has('vaccine_center_id'))
                    <div class="invalid-feedback" style="display:block;">
                        {{ $errors->first('vaccine_center_id') }}
                    </div>
                @endif
            </div>

            <!-- Appointment Date -->
            <div class="form-group mb-3 {{ $errors->has('appointment_date') ? 'has-error' : '' }}">
                {!! Form::label('appointment_date', "Appointment Date", ['class' => 'form-label required']) !!}
                {!! Form::date('appointment_date', old('appointment_date'), [
                    'class' => 'form-control' . ($errors->has('appointment_date') ? ' is-invalid' : ''),
                    'required' => true,
                    'id' => 'appointment_date',
                    'min' => date('Y-m-d')
                ]) !!}
                @if ($errors->has('appointment_date'))
                    <div class="invalid-feedback" style="display:block;">
                        {{ $errors->first('appointment_date') }}
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
                {!! Form::button('<i class="fas fa-calendar-plus me-2"></i>Create Appointment', [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'id' => 'submitButton'
                ]) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('footer-script')
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({ width: '100%' });
        $('#reset_button').on('click', function() {
            $('.select2').val(null).trigger('change');
        });
    });
</script>
@endsection

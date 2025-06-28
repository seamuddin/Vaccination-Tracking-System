@extends('layouts.admin')

@section('header-resources')
    @include('partials.datatable_css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2 { width: 100% !important; }
    </style>
@endsection

@section('content')
    {!! Form::open([
        'route' => 'quick.vaccination.store',
        'method' => 'post',
        'id' => 'quick_vaccination_form',
        'enctype' => 'multipart/form-data',
        'files' => true,
        'role' => 'form',
    ]) !!}
    <div class="row">
        <div class="col-md-12 p-5 pt-3">
            <div class="card card-outline card-primary form-card">
                <div class="card-header">
                    <h3 class="card-title pt-2 pb-2">Child Quick Vaccination</h3>
                    <div class="card-tools">
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">
                            <i class="bx bx-arrow-back pr-2"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body demo-vertical-spacing">

                    <!-- Select Child -->
                    <div class="input-group row {{ $errors->has('child_id') ? 'has-error' : '' }}">
                        {!! Form::label('child_id', 'Select Child:', ['class' => 'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::select('child_id', $children, old('child_id'), ['class' => 'form-control required select2', 'placeholder' => '-- Select --', 'required']) !!}
                            {!! $errors->first('child_id','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Select Vaccine -->
                    <div class="input-group row {{ $errors->has('vaccine_id') ? 'has-error' : '' }}">
                        {!! Form::label('vaccine_id', 'Select Vaccine:', ['class' => 'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::select('vaccine_id', $vaccines, old('vaccine_id'), ['class' => 'form-control required select2', 'placeholder' => '-- Select --', 'required']) !!}
                            {!! $errors->first('vaccine_id','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Dose Number -->
                    <div class="input-group row {{ $errors->has('dose_number') ? 'has-error' : '' }}">
                        {!! Form::label('dose_number', 'Dose Number:', ['class' => 'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::number('dose_number', old('dose_number'), ['class' => 'form-control required', 'min' => 1, 'required']) !!}
                            {!! $errors->first('dose_number','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Vaccination Date -->
                    <div class="input-group row {{ $errors->has('date_given') ? 'has-error' : '' }}">
                        {!! Form::label('date_given', 'Vaccination Date:', ['class' => 'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::date('date_given', old('date_given'), ['class' => 'form-control required', 'required']) !!}
                            {!! $errors->first('date_given','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="input-group row {{ $errors->has('status') ? 'has-error' : '' }}">
                        {!! Form::label('status', 'Status:', ['class' => 'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::select('status', ['given' => 'Given', 'missed' => 'Missed'], old('status'), ['class' => 'form-control required', 'required']) !!}
                            {!! $errors->first('status','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Submit and Reset Buttons -->
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            {!! Form::button('Submit', [
                                'type' => 'submit',
                                'class' => 'btn btn-success'
                            ]) !!}
                            {!! Form::button('Reset', [
                                'type' => 'reset',
                                'class' => 'btn btn-secondary ms-2',
                                'id' => 'reset_button'
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('footer-script')

    <script type="text/javascript" src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $(function() {
            // Initialize select2
            $('.select2').select2();

            // Validate the correct form
            $("#quick_vaccination_form").validate({
                errorPlacement: function () {
                    return true;
                },
            });

            // Reset form fields when Reset button is clicked
            $('#reset_button').click(function() {
                $('#quick_vaccination_form')[0].reset(); // Reset all form fields
                $('.select2').val(null).trigger('change'); // Reset select2 fields
            });

            let today = new Date().toISOString().split('T')[0];
            $('#date_given').val(today);

            $('#status').val('given').trigger('change');
        });
    </script>
@endsection

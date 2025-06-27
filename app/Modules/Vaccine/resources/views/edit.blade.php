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
        'route' => 'vaccine.store',
        'method' => 'post',
        'id' => 'form_id',
        'enctype' => 'multipart/form-data',
        'files' => 'true',
        'role' => 'form',
    ]) !!}
    <input type="hidden" name="id" value="{{ $vaccine->id }}">
    <div class="row">
        <div class="col-md-12 p-5 pt-3">
            <div class="card card-outline card-primary form-card">
                <div class="card-header">
                    <h3 class="card-title pt-2 pb-2"> Edit Vaccine </h3>
                    <div class="card-tools">
                        <a href="{{ route('vaccine.list') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-list-ul pr-2"></i> Vaccine List
                        </a>
                    </div>
                </div>
                <div class="card-body demo-vertical-spacing">
                    <!-- Vaccine Name -->
                    <div class="input-group row {{$errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name','Vaccine Name:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', old('name', $vaccine->name), ['class' => 'form-control required']) !!}
                            {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Manufacturer -->
                    <div class="input-group row {{$errors->has('manufacturer') ? 'has-error' : ''}}">
                        {!! Form::label('manufacturer','Manufacturer:',['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('manufacturer', old('manufacturer', $vaccine->manufacturer), ['class' => 'form-control', 'rows' => 2]) !!}
                            {!! $errors->first('manufacturer','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="input-group row {{$errors->has('description') ? 'has-error' : ''}}">
                        {!! Form::label('description','Description:',['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('description', old('description', $vaccine->description), ['class' => 'form-control', 'rows' => 3]) !!}
                            {!! $errors->first('description','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Doses Required -->
                    <div class="input-group row {{$errors->has('doses_required') ? 'has-error' : ''}}">
                        {!! Form::label('doses_required','Doses Required:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::select('doses_required', [0 => 'No', 1 => 'Yes'], old('doses_required', $vaccine->doses_required), ['class' => 'form-control required']) !!}
                            {!! $errors->first('doses_required','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Age Due Days -->
                    <div class="input-group row {{$errors->has('age_due_days') ? 'has-error' : ''}}">
                        {!! Form::label('age_due_days','Age Due (Days):',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::number('age_due_days', old('age_due_days', $vaccine->age_due_days), ['class' => 'form-control required', 'min' => 0]) !!}
                            <p>Note: Age due is in days from date of birth (e.g., 42 days ≈ 6 weeks)</p>
                            {!! $errors->first('age_due_days','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Number of Doses -->
                    <div class="input-group row {{$errors->has('number_of_doses') ? 'has-error' : ''}}">
                        {!! Form::label('number_of_doses','Number of Doses:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::number('number_of_doses', old('number_of_doses', $vaccine->number_of_doses), ['class' => 'form-control required', 'min' => 1]) !!}
                            {!! $errors->first('number_of_doses','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Dose Interval Days -->
                    <div class="input-group row {{$errors->has('dose_interval_days') ? 'has-error' : ''}}">
                        {!! Form::label('dose_interval_days','Dose Interval (Days):',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::number('dose_interval_days', old('dose_interval_days', $vaccine->dose_interval_days), ['class' => 'form-control required', 'min' => 0]) !!}
                            {!! $errors->first('dose_interval_days','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Update and Reset Buttons -->
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            {!! Form::button('Update Vaccine', [
                                'type' => 'submit',
                                'class' => 'btn btn-primary'
                            ]) !!}
                            {!! Form::button('Reset', [
                                'type' => 'button',
                                'class' => 'btn btn-secondary',
                                'id' => 'reset_button'
                            ]) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

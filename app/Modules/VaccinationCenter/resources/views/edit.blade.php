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
        'route' => 'vaccinationcenter.store',
        'method' => 'post',
        'id' => 'form_id',
        'enctype' => 'multipart/form-data',
        'files' => 'true',
        'role' => 'form',
    ]) !!}
    <input type="hidden" name="id" value="{{ $center->id }}">
    <div class="row">
        <div class="col-md-12 p-5 pt-3">
            <div class="card card-outline card-primary form-card">
                <div class="card-header">
                    <h3 class="card-title pt-2 pb-2"> Edit Vaccination Center </h3>
                    <div class="card-tools">
                        <a href="{{ route('vaccinationcenter.list') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-list-ul pr-2"></i> Center List
                        </a>
                    </div>
                </div>
                <div class="card-body demo-vertical-spacing">
                    <!-- Center Name -->
                    <div class="input-group row {{$errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name','Center Name:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', old('name', $center->name), ['class' => 'form-control required']) !!}
                            {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Address -->
                    <div class="input-group row {{$errors->has('address') ? 'has-error' : ''}}">
                        {!! Form::label('address','Address:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('address', old('address', $center->address), ['class' => 'form-control required', 'rows' => 2]) !!}
                            {!! $errors->first('address','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="input-group row {{$errors->has('phone') ? 'has-error' : ''}}">
                        {!! Form::label('phone','Contact Number:',['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('phone', old('phone', $center->phone), ['class' => 'form-control']) !!}
                            {!! $errors->first('phone','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="input-group row {{$errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email','Email:',['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::email('email', old('email', $center->email), ['class' => 'form-control']) !!}
                            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Google Place ID -->
                    <div class="input-group row {{$errors->has('google_place_id') ? 'has-error' : ''}}">
                        {!! Form::label('google_place_id','Google Place ID:',['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('google_place_id', old('google_place_id', $center->google_place_id), ['class' => 'form-control']) !!}
                            {!! $errors->first('google_place_id','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Latitude -->
                    <div class="input-group row {{$errors->has('latitude') ? 'has-error' : ''}}">
                        {!! Form::label('latitude','Latitude:',['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::number('latitude', old('latitude', $center->latitude), ['class' => 'form-control']) !!}
                            {!! $errors->first('latitude','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Longitude -->
                    <div class="input-group row {{$errors->has('longitude') ? 'has-error' : ''}}">
                        {!! Form::label('longitude','Longitude:',['class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::number('longitude', old('longitude', $center->longitude), ['class' => 'form-control']) !!}
                            {!! $errors->first('longitude','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Status (is_active) -->
                    <div class="input-group row {{$errors->has('is_active') ? 'has-error' : ''}}">
                        {!! Form::label('is_active','Status:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::select('is_active', [1 => 'Active', 0 => 'Inactive'], old('is_active', $center->is_active), ['class' => 'form-control required']) !!}
                            {!! $errors->first('is_active','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Update and Reset Buttons -->
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            {!! Form::button('Update Center', [
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

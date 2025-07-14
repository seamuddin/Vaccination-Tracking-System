@extends('layouts.admin')

@section('header-resources')
    @include('partials.datatable_css')

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection


@section('content')
    {!! Form::open([
        'route' => 'child.register.store',
        'method' => 'post',
        'id' => 'form_id',
        'enctype' => 'multipart/form-data',
        'files' => true,
        'role' => 'form',
    ]) !!}
    <div class="row">
        <div class="col-md-12 p-5 pt-3">
            <div class="card card-outline card-primary form-card">
                <div class="card-header">
                    <h3 class="card-title pt-2 pb-2">Update Child</h3>
                    <div class="card-tools">
                        <a href="{{ route('child.list') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-list-ul pr-2"></i> Child List
                        </a>
                    </div>
                </div>

                <div class="card-body demo-vertical-spacing">

                    {!! Form::hidden('id', $child->id) !!}

                    <!-- Child Name -->
                    <div class="input-group row {{$errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name','Child Name:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', $child->name, ['class' => 'form-control required']) !!}
                            {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="input-group row {{$errors->has('date_of_birth') ? 'has-error' : ''}}">
                        {!! Form::label('date_of_birth','Date of Birth:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::date('date_of_birth', $child->date_of_birth, ['class' => 'form-control required']) !!}
                            {!! $errors->first('date_of_birth','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class="input-group row {{$errors->has('gender') ? 'has-error' : ''}}">
                        {!! Form::label('gender','Gender:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::select('gender', ['male'=>'Male', 'female'=>'Female', 'Other'=>'Other'], $child->gender, ['class' => 'form-control select2']) !!}
                            {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Parent -->
                    <div class="input-group row {{$errors->has('parent_id') ? 'has-error' : ''}}">
                        {!! Form::label('parent_id','Parent:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::select('parent_id', $parents, old('parent_id', $child->parent_id), ['class' => 'form-control required select2']) !!}
                            {!! $errors->first('parent_id','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Parent Contact -->
                    <div class="input-group row {{$errors->has('parent_contact') ? 'has-error' : ''}}">
                        {!! Form::label('parent_contact','Parent Contact:',['class'=>'col-md-3 control-label required-star']) !!}
                        <div class="col-md-9">
                            {!! Form::text('parent_contact', old('parent_contact', $child->guardian_contact), ['class' => 'form-control required']) !!}
                            {!! $errors->first('parent_contact','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <!-- Update Button -->
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            {!! Form::button('Update', [
                                'type' => 'submit',
                                'class' => 'btn btn-primary'
                            ]) !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@section('footer-script')

    <script type="text/javascript" src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $("#form_id").validate({
                errorPlacement: function () {
                    return true;
                },
            });
        });
    </script>
@endsection

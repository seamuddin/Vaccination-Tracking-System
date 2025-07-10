@extends('parent-dashboard.main')
@section('header-resources')

@endsection

@section('body')
  <div class="row">
        <div class="col-md-12 p-5 pt-3">
            <div class="card card-outline card-primary form-card">
                <div class="card-header">
                    <h3 class="card-title pt-2 pb-2"><i class="fa fa-list"></i> Reset Password </h3>
                    <div class="card-tools">
                        <!-- <a href="" class="btn btn-primary">Add</a> -->
                    </div>
                    <!-- /.card-tools -->
                </div>
                {!! Form::open([
                'url' => "/gurdian/reset-password",
                'method' => 'post',
                'id' => 'form_id',
                'enctype' => 'multipart/form-data',
                'files' => 'true',
                'role' => 'form',
                ]) !!}

                <div class="row p-4">
                    <div class="col-md-12 mb-3 {{$errors->has('old_password') ? 'has-error' : ''}}">
                        <div class="col-md-12">
                            {!! Form::password('old_password', ['class' => 'form-control required', 'placeholder' => 'Old Password']) !!}
                            {!! $errors->first('old_password','<span class="help-block">:message</span>') !!}
                        </div>

                    </div>

                    <div class="col-md-12 mb-3 {{$errors->has('new_password') ? 'has-error' : ''}}">
                        <div class="col-md-12">
                            {!! Form::password('new_password', ['class' => 'form-control required', 'placeholder' => 'New Password']) !!}
                            {!! $errors->first('new_password','<div class="help-block">:message</div>') !!}
                        </div>
                    </div>


                    <div class="col-md-12">
                        <button class="btn btn-primary">Next</button>
                    </div>

                </div>

                {!! form::close() !!}

            </div><!-- /.panel -->

        </div>
    </div>
@endsection
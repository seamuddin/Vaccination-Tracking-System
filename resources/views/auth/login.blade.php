@extends('frontend.main')
@section('styles')
    <style>
        .authentication-wrapper.authentication-basic .authentication-inner {
            max-width: 400px;
        }
        .btn-primary {         
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                border: none;
                color: white;
                padding: 0.875rem 2rem;
                border-radius: 10px;
                font-weight: 600;
                font-size: 1rem;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
                width: 100%;
            }
    </style>
@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">

                                </span>

                                <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
                                    <h2 class="m-0 text-primary"><i class="fas fa-syringe me-2"></i>VaxTracker</h2>
                                </a>
                            </a>
                        </div>
                        <!-- /Logo -->

                        {!! Form::open(['route' => 'login.check','method' => 'post','id' => 'form_id','enctype' => 'multipart/form-data','files' => 'true','role' => 'form']) !!}
                        <div class="mb-3">
                            <div class=" {{$errors->has('email') ? 'has-error' : ''}}">
                                {!! Form::label('email','Email',['class'=>'col-md-12 form-label required-star']) !!}
                                <div class="col-md-12">
                                    {!! Form::text('email', old('email'), ['class' => 'form-control required', 'placeholder' => 'Enter your email', 'autofocus'=>'true']) !!}
                                    {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class=" mb-3 form-password-toggle  {{$errors->has('password') ? 'has-error' : ''}}">
                            <div class="d-flex justify-content-between">
                                {!! Form::label('password','Password',['class'=>'form-label required-star']) !!}
                                <a href="">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>

                            <div class="input-group">
                                {!! Form::password('password', ['class' => 'form-control required', 'placeholder' => 'Enter your password']) !!}
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}

                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me"/>
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                        {!! form::close() !!}

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{ url('register') }}">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
@endsection

@extends('parent-dashboard.main')
@section('header-resources')

@endsection

@section('body')


 <div class="main-container">
     
        <!-- Update Profile Form -->
        <div class="row mt-5">
            <div class="col-md-12 p-5 pt-3">
                <div class="card card-outline card-primary form-card">
                    <div class="card-header">
                        <h3 class="card-title pt-2 pb-2"> Update Profile</h3>
                    </div>
                    {!! Form::open([
                        'route' => 'profile.update',
                        'method' => 'post',
                        'id' => 'form_id',
                        'enctype' => 'multipart/form-data',
                        'files' => true,
                        'role' => 'form',
                    ]) !!}

                    <div class="row p-4">
                        <div class="col-md-12">
                            <div class="form-group row has-feedback">
                                <div id="browseimagepp">
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        <div class="col-md-12 addImages">
                                            <label class="center-block image-upload" for="user_pic">
                                                <figure>
                                                    <img
                                                        src="{{ !empty(Auth::user()->image) ? url(Auth::user()->image) : url('images/no_image.png') }}"
                                                        class="img-responsive img-thumbnail" id="user_pic_preview"
                                                        width="150px" height="150px">
                                                </figure>
                                                <input type="hidden" id="user_pic_base64" name="user_pic_base64" value="">
                                                @if(!empty(Auth::user()->image))
                                                    <input type="hidden" name="user_pic" value="{{ Auth::user()->image }}"/>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pb-3">
                            <h4 id="profile_image">
                                <label for="user_pic" class="required-star ">Profile image</label>
                            </h4>
                            <p class="text-success fw-bold small">[File Format: *.jpg/ .jpeg/ .png | Width 300PX, Height 300PX]</p>
                            <span id="user_err" class="text-danger" style="font-size: 10px;"></span>
                            <input type="file" class="form-control" name="user_pic" id="user_pic"
                                   onchange="imageUploadWithCroppingAndDetect(this, 'user_pic_preview', 'user_pic_base64')"
                                   size="300x300">
                        </div>

                        <div class="col-md-12 {{$errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::label('email','Email:',['class'=>'control-label required-star pb-1']) !!}
                            <div class="pb-3">
                                {!! Form::text('email', Auth::user()->email, ['class' => 'form-control required']) !!}
                                {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                            </div>
                        </div>

                        <div class="col-md-12 {{$errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name','User Name:',['class'=>'control-label required-star pb-1']) !!}
                            <div class="pb-3">
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control required']) !!}
                                {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                            </div>
                        </div>

                       

                        <div class="col-md-12">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ url('reset_password') }}" class="btn btn-primary">Reset Password</a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

</div>

    @include('plugins/image_upload')

@endsection
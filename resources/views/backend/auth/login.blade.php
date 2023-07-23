@extends('backend.layouts.empty')

@section('body_class','pace-top')

@section('title', __('backend.login'))

@section('content')
    <!-- begin login -->
    <div class="login login-v1">
        <!-- begin login-container -->
        <div class="login-container">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>{{ env('APP_NAME') }}</b>
                    <small>@lang('auth.admin_panel')</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end login-header -->

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (!$errors->isEmpty())
                <div class="alert alert-danger" role="alert">
                    {!! $errors->first() !!}
                </div>
        @endif

        <!-- begin login-body -->
            <div class="login-body">
                <!-- begin login-content -->
                <div class="login-content">
                    {{ Form::open(['route' => 'backend.login', 'autocomplete' => 'off', 'class' => 'margin-bottom-0']) }}
                    <div class="form-group m-b-20">
                        {!! Form::email('email', old('email'), ['placeholder' => __('auth.email_address'), 'class'=>'form-control form-control-lg inverse-mode', 'required', 'autofocus']) !!}
                    </div>
                    <div class="form-group m-b-20">
                        {!! Form::password('password', ['placeholder' => __('auth.password'),'class'=>'form-control form-control-lg inverse-mode', 'required']) !!}
                    </div>
                    <div class="checkbox checkbox-css m-b-20">
                        <input type="checkbox" name="remember" id="remember_checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember_checkbox">
                            @lang('backend.remember_me')
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">@lang('backend.login')</button>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- end login-content -->
            </div>
            <!-- end login-body -->
        </div>
        <!-- end login-container -->
    </div>
    <!-- end login -->
@endsection

@section('scripts')
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection

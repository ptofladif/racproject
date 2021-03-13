@extends('layouts.app')

@section('content')
<div class="register-box">
    <div class="login-logo">
        <strong>
            <a href="#" style="color: white;">
                {{ trans('global.site_title') }}
            </a>
        </strong>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="register-box-msg">Sign up to start your session</p>
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ trans('global.user_name') }}" name="name" required autofocus>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ trans('global.login_email') }}" name="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('global.login_password') }}" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('global.login_password_confirmation') }}" name="password_confirmation" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('global.register') }}</button>
                    </div>
                </div>
            </form>
            <p class="mb-1" style="margin-top: 0.5rem">
                <a class="" href="{{ route('login') }}">
                    {{ trans('global.already_registered') }}
                </a>
            </p>
        </div>
    </div>
</div>

</div>
@endsection

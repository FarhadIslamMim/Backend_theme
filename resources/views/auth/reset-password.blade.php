@extends('layouts.admin-auth')

@section('content')
<div class="login-box-body">
    <p class="login-box-msg">{{ __('Reset Password') }}</p>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

         <!-- Password Reset Token -->
         <input type="hidden" name="token" value="{{ $request->route('token') }}">


        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <x-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus />

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-custom btn-block btn-flat">
                    {{ __('Reset Password') }}
                </button>
            </div>

            <div class="col-xs-12 text-center pt-15">
                <a href="{{ route('login') }}"><i class="fa fa-angle-double-left" aria-hidden="true"></i> {{ __('back to login') }}</a>
            </div>
        </div>
    </form>
</div>
@endsection

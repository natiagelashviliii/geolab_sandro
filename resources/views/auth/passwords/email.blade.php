@extends('index')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/admin/auth.css') }}">
@endsection

@section('content')

<div class="container login-form-container">
    <form class="login-form" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
        @csrf
        <div class="row">
            <div class="login-header col s12 center-align">
                <p>Password Reset</p>
            </div>
            <div class="input-field col s12">
                <i class="fa fa-at prefix" aria-hidden="true"></i>
                <input id="icon_prefix" type="text" value="{{ old('email') }}" class="validate {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                <label for="icon_prefix">Email</label>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col s12 right-align">
                <button class="waves-effect waves-light btn-small btn" type="submit">{{ __('Send Password Reset Link') }}</button>
            </div>
        </div>
    </form>
</div>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection

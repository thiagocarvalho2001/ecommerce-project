@extends('adminlte::master')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        body {
            background: linear-gradient(to right, #4b6cb7, #182848);
            color: white;
        }
        .login-box {
            background: rgba(0, 0, 0, 0.3);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
        .btn-primary {
            background-color: #4b6cb7;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3a589d;
        }
    </style>
@stop

@section('body')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}" style="color: white;">
                <b>Login</b>
            </a>
        </div>

        <div class="card-body login-card-body">
            <p class="login-box-msg">Login first</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" placeholder="Email" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Remember</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
            </form>

            <p class="mt-3">
                <a href="{{ route('password.request') }}">Forgot password</a>
            </p>
            <p>
                <a href="{{ route('register') }}" class="text-center">Create a new account</a>
            </p>
        </div>
    </div>
</div>
@stop

@extends('app')

@section('title')
    Login to ETX Events
@endsection

@section('content')

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (count($errors) > 0)
        <ul class="alert alert-danger">
        @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
        </ul>
    @endif

    <div class="container">
        <div class="col-md-6">
            <h3>Login Into Your Account</h3>
            <form class="form-group-lg" id="frm_login" action="/auth/login" method="post">
                <div class="input-group">
                    <input class="form-control input-lg" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email Address" />
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                </div>
                <div>&nbsp;</div>
                <div class="input-group">
                    <input class="form-control input-lg" type="password" name="password" id="password" placeholder="Password" />
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                </div>
                <div>&nbsp;</div>
                <input class="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                <button class="btn btn-success form-control h3"><span class="h3">Login</span></button>
                <div>&nbsp;</div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <input type="checkbox"> Remember Me
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/forgot-password">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <p class="text-right"><a href="/auth/register">Don't have an account?  Sign Up!</a></p>
            <p><a href="/social/facebook"><img class="img-responsive center-block" src="/images/login_facebook.jpg" alt="Sign in with Facebook"></a></p>
            <p><a href="/social/google"><img class="img-responsive center-block" src="/images/login_google.jpg" alt="Login with Google" /></a></p>
            <p><a href="/social/twitter"><img class="img-responsive center-block" src="/images/login_twitter.jpg" alt="Login with Twitter" /></a></p>
        </div>
    </div>

@endsection
@extends('app')

@section('title')
    Register for your ETX Event Account
@endsection


@section('content')


    @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif

    <div class="container">
        <h3>Create your ETX Events Account</h3>
        <p>Please use the form below to create your ETX Event account or sign up with social media.</p>

        <div class="col-md-6">
            <form class="form-group-lg" id="frm_register" action="/auth/register" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-6 ">
                        <input class="form-control input-lg" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" />
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control input-lg" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" />
                    </div>
                </div>
                <div>&nbsp;</div>
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
                <button class="btn btn-success form-control h3"><span class="h3">Register</span></button>
                <div>&nbsp;</div>

            </form>
        </div>

        <div class="col-md-6">
            <p><a href="/social/facebook"><img class="img-responsive center-block" src="/images/login_facebook.jpg" alt="Sign in with Facebook"></a></p>
            <p><a href="/social/google"><img class="img-responsive center-block" src="/images/login_google.jpg" alt="Login with Google" /></a></p>
            <p><a href="/social/twitter"><img class="img-responsive center-block" src="/images/login_twitter.jpg" alt="Login with Twitter" /></a></p>
        </div>
    </div>
@endsection
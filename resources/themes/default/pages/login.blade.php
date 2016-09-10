@extends('layouts.main')
@section('content')


    <style>
        .main {
            max-width: 300px;
            margin: 0 auto;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="main">
                <h3>Please Login, or <a href="/register">Register</a></h3>


                {{ Form::open(array('url' => 'login')) }}
                <h1>Login</h1>


                <p style="color: red">
                    {{ $errors->first('email') }} <br>
                    {{ $errors->first('password') }}
                </p>


                <div class="form-group">
                    {{ Form::label('email', 'Email Address') }}
                    {{ Form::text('email', Input::old('email'), array('placeholder' => 'user@example.com','class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    <a class="pull-right" href="/forgot_password">Forgot password?</a>
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password',array('class' => 'form-control')) }}
                </div>
                <div class="checkbox pull-right">
                    <label>
                        <input type="checkbox">
                        Remember me </label>
                </div>

                {!! Recaptcha::render() !!}

                <br> <br> <br>

                <p>{{ Form::submit('Login',array('class' => 'btn btn btn-primary')) }}</p>
                {{ Form::close() }}
            </div>
        </div>

    </div>


@stop
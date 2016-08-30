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
                <h3>If already registered please <a href="/login">login </a></h3>


                {{ Form::open(array('url' => 'register')) }}
                <h1>Register</h1>


                <p style="color: red">
                    {{ $errors->first('email') }} <br>
                    {{ $errors->first('password') }}
                </p>


                <div class="form-group">
                    {{ Form::label('email', 'Email Address') }}
                    {{ Form::text('email', Input::old('email'), array('placeholder' => 'user@example.com','class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password',array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Confirm Password') }}
                    {{ Form::password('password_confirmation',array('class' => 'form-control')) }}
                </div>


                <p>{{ Form::submit('Register',array('class' => 'btn btn btn-primary')) }}</p>
                {{ Form::close() }}
            </div>
        </div>

    </div>


@stop

@extends('layouts.main')
@section('content')



    <h1>Contact</h1>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    {{ Form::open(array('url' => 'contact')) }}

    <p style="color: red">
        {{ $errors->first('email') }} <br>
        {{ $errors->first('password') }}
    </p>


    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email',Input::old('email'),array('placeholder' => 'user@example.com','class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('message', 'Message') }}
        {{ Form::textarea('message',Input::old('message'),array('placeholder' => 'Message','class' => 'form-control')) }}
    </div>

    <p>{{ Form::submit('Send',array('class' => 'btn btn btn-primary')) }}</p>
    {{ Form::close() }}

@stop
@extends('layouts.lmain')
@section('content')

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">


    <h1>Edit Profile</h1>


    @if (session('next-page'))


        <p style="color: red"> Please complete the form below to continue</p>

    @endif

@include('partials._form-error')

    <?php
    $dob="";

    ?>

    @if(count($profile)>0)


<?php $profile=$profile[0]; ?>

<?php $dob=$profile->dob;?>

    {{ Form::model($profile, array('action' => array('UserDetailController@update'))) }}

<input type="hidden" name="profile_id" value="{{$profile->profile_id}}">

    @else
        {{ Form::open(array('action' => 'UserDetailController@store')) }}

        @endif



    @if (session('next-page'))



        <input type="hidden" name="next_page" value="{{session('next-page')}}">

    @endif

    {{Form::label('name',"Name")}}
    {{Form::text('name', Input::old('name'), array('class'=>"form-control"))}}
    {{Form::label('phone',"Phone")}}
    {{Form::text('phone', Input::old('phone'), array('class'=>"form-control"))}}

    {{Form::label('dob',"Date of Birth")}}
    {{ Form::text('dob', date('d/m/y', strtotime($dob) )  , array('id' => 'datepicker','class'=>"form-control")) }}

    <br>

    {{Form::submit('Update', array('class'=>"btn btn-primary"))}}


    {{ Form::close() }}

    <br>


    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>

    @stop



@extends('layouts.lmain')
@section('content')




    <h1>Your Profile</h1>

    <br>  <br>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
        <hr>

        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="well">
                            <h4 class="text-danger">

                             <h3>{{ $profile[0]->name }}</h3>    <br>
                             Phone:   {{ $profile[0]->phone }} <br>
                             Date of Birth:    {{   date('F d, Y', strtotime($profile[0]->dob)) }} <br>
                             Support PIN:   {{  $profile[0]->pin }}* <br>

                                <p style="color: red">*Please provide us with
                                this PIN number when you contact us on the phone. Thank you!</p>
                                <a class="btn btn-small btn-info" href="/account/profile/edit">Edit your profile</a>

                            </h4>
                        </div>
                    </div>


                </div>
            </div>
        </div>


@stop
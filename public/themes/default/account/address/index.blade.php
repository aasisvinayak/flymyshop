@extends('layouts.lmain')
@section('content')




    <h1>Addresses</h1>


    <a style="float: right" class="btn btn-small btn-success" href="/account/addresses/create">Add new Address</a>


    <br>  <br>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

        @foreach($addresses as $key => $value)




            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                <h4 class="text-danger">
                                    {{ $value->address_l1 }} <br>
                                    {{ $value->address_l2 }} <br>
                                    {{ $value->city }} <br>
                                    {{ $value->state }} <br>
                                    {{ $value->postcode }} <br>
                                    {{ $value->country }} <br><br>

                                    <a class="btn btn-small btn-info" href="/account/addresses/{{$value->address_id}}/edit">Edit this Address</a>
                                    {{ Form::model($value,array('action' => array('AddressController@destroy', $value->address_id), 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete this entry', array('class' => 'btn btn-danger')) }}
                                    {{ Form::close() }}

                                </h4>
                            </div>
                        </div>


                    </div>
                </div>
            </div>








        @endforeach



    @stop
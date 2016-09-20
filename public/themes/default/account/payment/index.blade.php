@extends('layouts.lmain')
@section('content')


    <h1>Payment Information</h1>


    <script src="/js/card.js"></script>



    <a style="float: right" class="btn btn-small btn-success" href="/account/payment_cards/create">Add new card</a>


    <br>  <br>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

        @foreach($payment_cards as $key => $value)

            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="well">
                                <h4 class="text-danger">


    <div class="card-wrapper-{{$value->card_id}}">
    </div>

    <script>

        var card = new Card({
            form: '.card-form',
            container: '.card-wrapper-{{$value->card_id}}',
            placeholders: {
                number: '**** **** **** {{$value->card_four_digit}}',
                name: '',
                expiry: '{{$value->expiry_month}}/{{$value->expiry_year}}',
            },
        });
    </script>

                                    <br>

                                    {{ Form::model($value,array('action' => array('PaymentCardController@destroy', $value->card_id), 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete card', array('class' => 'btn btn-danger')) }}
                                    {{ Form::close() }}

                                </h4>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    @stop
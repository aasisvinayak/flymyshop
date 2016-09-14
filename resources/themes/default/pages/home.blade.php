@extends('layouts.main')
@section('content')

    <style>
        .btn-product{
            width: 100%;
        }
    </style>

    <div class="jumbotron text-center">

        <h1>Welcome to {{config('flymyshop.shopName')}}</h1>


    </div>

    <div class="container">
        <div class="row">

            @include('partials._product-list')

        </div>
    </div>

@stop
@extends('layouts.main')
@section('content')


    @include('partials._form-error')

    {{Form::model($product,array('action'=> array('ProductController@update', $product->id), 'method'=>"PATCH"))}}

    @include('partials._product-form',array('productButton'=>'Edit Product'))

    {{Form::close()}}

@stop

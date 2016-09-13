@extends('admin-layouts.admin')
@section('title')
    Edit product
@stop

@section('content')


    @include('admin-partials._form-error')

    {{Form::model($product,array('action'=> array('ProductController@update', $product->id), 'method'=>"PATCH"))}}

    @include('admin-partials._product-form',array('productButton'=>'Edit Product'))

    {{Form::close()}}

@stop

@extends('layouts.main')
@section('content')

@include('partials._form-error')

{{Form::open(array("action" => array("CategoryController@update",$category->id) , "method" => "PATCH"))}}

@include('partials._category-form',array("button_name" => "Update"))

{{Form::close()}}

@stop
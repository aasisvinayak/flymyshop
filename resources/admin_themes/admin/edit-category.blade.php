@extends('admin-layouts.admin')
@section('title')
    Edit category
@stop

@section('content')

@include('partials._form-error')

{{Form::model($category, array("action" => array("CategoryController@update",$category->id) , "method" => "PATCH"))}}
@include('partials._category-form',array("button_name" => "Update"))
{{Form::close()}}

@stop
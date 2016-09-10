@extends('layouts.main')
@section('content')


    <h1>Add Category</h1>

    @include('partials._form-error')

    {{Form::open( array('action' => "CategoryController@store"))}}
    @include('partials._category-form',array("button_name" => "Add"))
    {{Form::close()}}

    @stop

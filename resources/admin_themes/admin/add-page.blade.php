@extends('admin-layouts.admin')
@section('title')
    Add a new page
@stop

@section('content')


    @include('partials._form-error')

    <div>



        <div class="container">
            <div class="row col-md-8  custyle">
    {{Form::open( array('action' => "PageController@store"))}}
                @include('partials._page-form',array("buttonName"=>"Add Page"))
    {{Form::close()}}

                <br><br>
            </div>
        </div>
    </div>

@stop

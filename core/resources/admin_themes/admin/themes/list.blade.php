@extends('admin-layouts.admin')
@section('title')
    Themes List         <a style="float: right;" class="btn btn-success btn-lg" href="/admin/add_theme">Add Theme</a>
    <br> <br>
@stop

@section('content')


    <div id="themes">

        <div class="col-md-8">

        <div class="row alert alert-warning">
            If you wish to change FlyMyShop's default theme, please update the preferred theme in <a href="/admin/settings">settings</a> .
        </div>



            @foreach($themes as $theme)


                    <div class="row well well-sm">
                        <div class=" section-box">
                            <h2>
                                {{$theme->name}}

                            </h2>

                        <span style="float: right">

                            <?php

                            ($theme->status == '1') ? $button = "Disable" : $button = "Enable";
                            ($theme->status == '1') ? $status = "0" : $status = "1";
                            ?>

                            <br>

                            {{Form::open(array('action'=>"ThemeController@deleteTheme"))}}
                            <input type="hidden" name="id" value="{{$theme->id}}">
                            {{Form::submit('Delete', array('class' =>" btn-danger  btn-sm"))}}
                            {{Form::close()}}
                        </span>
                            <p>
                                {{$theme->theme_description}}</p>

                            <br><br>
                            <hr>

                            <div class="row plugin-desc">
                                <div class="col-md-12">
                                    Version: {{$theme->theme_version}}
                                    <span class="separator">|</span>
                                    Author: {{$theme->theme_author}}
                                </div>
                            </div>

                        </div>
                    </div>




            @endforeach

        </div>

        {{ $themes->links() }}
    </div>
@stop
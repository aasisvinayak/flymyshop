@extends('admin-layouts.admin')
@section('title')
    Plugins List         <a style="float: right;" class="btn btn-success btn-lg" href="/admin/add_plugin">Add Plugin</a>
    <br> <br>
@stop

@section('content')


    <div id="plugins">

        <style>
            body {
                margin-top: 20px;
            }

            .section-box h2 {
                margin-top: 0px;
            }

            .section-box h2 a {
                font-size: 15px;
            }

            .separator {
                padding-right: 5px;
                padding-left: 5px;
            }

            .section-box hr {
                margin-top: 0;
                margin-bottom: 5px;
                border: 0;
                border-top: 1px solid rgb(199, 199, 199);
            }
        </style>

        <ul>
            @foreach($plugins as $plugin)

                <div class="col-md-8">
                    <div class="row well well-sm">
                        <div class=" section-box">
                            <h2>
                                {{$plugin->name}}

                            </h2>

                        <span style="float: right">

                            <?php

                            ($plugin->status == '1') ? $button = "Disable" : $button = "Enable";
                            ($plugin->status == '1') ? $status = "0" : $status = "1";
                            ?>
                            {{Form::open(array('action'=>"PluginController@changePluginStatus"))}}
                            <input type="hidden" name="id" value="{{$plugin->id}}">
                                  <input type="hidden" name="status" value="{{$status}}">

                            {{Form::submit($button, array('class' =>" btn-primary  btn-sm"))}}
                            {{Form::close()}}

                            <br>

                            {{Form::open(array('action'=>"PluginController@deletePlugin"))}}
                            <input type="hidden" name="id" value="{{$plugin->id}}">
                            {{Form::submit('Delete', array('class' =>" btn-danger  btn-sm"))}}
                            {{Form::close()}}
                        </span>
                            <p>
                                {{$plugin->plugin_description}}</p>

                            <br><br> <br> <br>
                            <hr>

                            <div class="row plugin-desc">
                                <div class="col-md-12">
                                    Version: {{$plugin->plugin_version}}
                                    <span class="separator">|</span>
                                    Author: {{$plugin->plugin_author}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            @endforeach

        </ul>

        {{ $plugins->links() }}
    </div>
@stop
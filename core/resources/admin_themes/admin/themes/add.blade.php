@extends('admin-layouts.admin')
@section('title')
    Add a new theme
@stop

@section('content')

    @include('admin-partials._pull-from-git', array(

                'type' => "Theme",
                'action' => "ThemeController@processAddTheme",
                'sample' => "fms_sample_theme",
                ))

@stop
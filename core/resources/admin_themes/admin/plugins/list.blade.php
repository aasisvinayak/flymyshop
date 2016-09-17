@extends('admin-layouts.admin')
@section('title')
    Plugin List
@stop

@section('content')

    <div id="plugins">

        <ul>

            <li v-for="item in plugins">
                @{{ item }}
            </li>

        </ul>





    </div>

    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>


@stop
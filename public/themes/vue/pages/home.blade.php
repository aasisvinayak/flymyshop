@extends('layouts.main')
@section('content')

    <div class="container" id="vuepage">


        <h2>Categories List</h2>

        <li v-for="item in categories">
            @{{ item.title }}
        </li>


        <h2>Product List</h2>

        <ul>

            <li v-for="item in products">
                @{{ item.title }}
            </li>

        </ul>


        {{token()}}


    </div>


    <script>


        <?php
            echo 'var products_array = ', json_encode(products(0,10)), ';';
            echo 'var categories_array = ', json_encode(categories()), ';';
        ?>

        new Vue({
            el: '#vuepage',
            data: {
                products:products_array,
                categories:categories_array
            },
        });


    </script>

   @stop
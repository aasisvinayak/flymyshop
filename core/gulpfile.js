var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// elixir(function(mix) {
//     mix.sass('app.scss');
// });


require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.scripts([
        'vendor/vue.min.js',
        'vendor/vue-resource.min.js',
    ], '../public/js/vendor.js');

    mix.scripts([
        'app.js',
    ], '../public/js/app.js');
    mix.phpUnit();
});


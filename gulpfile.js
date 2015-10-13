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

elixir(function(mix) {
    mix.sass(
            [
                'app.scss'
            ],
            'public/css',
            {
                includePaths: [
                    'bower_components/foundation/scss'
                ]
            }
        )
        .styles(
            [
                '../../bower_components/foundation/css/normalize.min.css',
                'app.css'
            ],
            'public/css/all.css',
            'public/css'
        )
        .scripts([
            'bower_components/foundation/js/vendor/jquery.js',
            'bower_components/foundation/js/vendor/fastclick.js',
            'bower_components/foundation/js/foundation.min.js'
        ],
        'public/js/vendor/foundation.js',
        '.'
        )
        .scripts([
            'bower_components/foundation/js/vendor/modernizr.js'
        ],
        'public/js/vendor/modernizr.js',
        '.');
});

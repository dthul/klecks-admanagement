const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass(
            [
                'app.scss'
            ],
            'public/css/app.css',
            {
                includePaths:
                [
                    'bower_components/foundation/scss'
                ]
            }
        )
        .sass(
            [
                'invoice.scss'
            ],
            'public/css/invoice.css'
        )
        .styles(
            [
                'bower_components/foundation/css/normalize.min.css',
                'bower_components/DataTables/media/css/dataTables.foundation.min.css',
                'bower_components/font-awesome/css/font-awesome.min.css',
                'public/css/app.css'
            ],
            'public/css/all.css',
            '.'
        )
        .scripts(
            [
                'bower_components/foundation/js/vendor/jquery.js',
                'bower_components/foundation/js/vendor/fastclick.js',
                'bower_components/foundation/js/foundation.min.js'
            ],
            'public/js/vendor/foundation.js',
            '.'
        )
        .scripts(
            [
                'bower_components/foundation/js/vendor/modernizr.js'
            ],
            'public/js/vendor/modernizr.js',
            '.'
        )
        .scripts(
            [
                'bower_components/DataTables/media/js/jquery.dataTables.min.js',
                'bower_components/DataTables/media/js/dataTables.foundation.min.js'
            ],
            'public/js/vendor/datatables.js',
            '.'
        )
        .copy(
            [
                'bower_components/DataTables/media/images/sort_asc.png',
                'bower_components/DataTables/media/images/sort_asc_disabled.png',
                'bower_components/DataTables/media/images/sort_both.png',
                'bower_components/DataTables/media/images/sort_desc.png',
                'bower_components/DataTables/media/images/sort_desc_disabled.png'
            ],
            'public/images'
        )
        .copy(
            [
                'bower_components/font-awesome/fonts'
            ],
            'public/fonts'
        )
    ;
});

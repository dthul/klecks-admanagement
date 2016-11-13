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
                'resources/assets/sass/app.scss'
            ],
            'public/css/app.css',
            '.',
            {
                includePaths:
                [
                    'node_modules/foundation-sites/scss'
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
                'node_modules/datatables.net-zf/css/dataTables.foundation.css',
                'node_modules/font-awesome/css/font-awesome.min.css',
                'public/css/app.css'
            ],
            'public/css/all.css',
            '.'
        )
        .scripts(
            [
                'node_modules/foundation-sites/vendor/jquery/dist/jquery.js',
                //'bower_components/foundation/js/vendor/fastclick.js',
                'node_modules/foundation-sites/js/foundation.core.js',
                'node_modules/foundation-sites/js/foundation.util.box.js',
                'node_modules/foundation-sites/js/foundation.util.keyboard.js',
                'node_modules/foundation-sites/js/foundation.util.mediaQuery.js',
                'node_modules/foundation-sites/js/foundation.util.motion.js',
                'node_modules/foundation-sites/js/foundation.util.triggers.js',
                'node_modules/foundation-sites/js/foundation.reveal.js',
            ],
            'public/js/vendor/foundation.js',
            '.'
        )
        .scripts(
            [
                'node_modules/datatables.net/js/jquery.dataTables.js',
                'node_modules/datatables.net-zf/js/dataTables.foundation.js',
            ],
            'public/js/vendor/datatables.js',
            '.'
        )
        .copy(
            [
                'node_modules/datatables.net-zf/images/sort_asc.png',
                'node_modules/datatables.net-zf/images/sort_asc_disabled.png',
                'node_modules/datatables.net-zf/images/sort_both.png',
                'node_modules/datatables.net-zf/images/sort_desc.png',
                'node_modules/datatables.net-zf/images/sort_desc_disabled.png'
            ],
            'public/images'
        )
        .copy(
            [
                'node_modules/font-awesome/fonts'
            ],
            'public/fonts'
        )
    ;
});

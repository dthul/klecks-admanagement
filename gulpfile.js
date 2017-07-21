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
                    'node_modules/foundation-sites/scss',
                    'node_modules/motion-ui/src'
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
        .copy(
            'node_modules/jquery/dist/jquery.min.js',
            'public/js/vendor/jquery.min.js'
        )
        .copy(
            'node_modules/what-input/dist/what-input.min.js',
            'public/js/vendor/what-input.min.js'
        )
        // Foundation stopped working when building it modularly so we include
        // the complete foundation.min.js now instead.
        // The old code:
        // .webpack(
        //     [
        //         'node_modules/foundation-sites/js/foundation.core.js',
        //         'node_modules/foundation-sites/js/foundation.util.box.js',
        //         'node_modules/foundation-sites/js/foundation.util.keyboard.js',
        //         'node_modules/foundation-sites/js/foundation.util.mediaQuery.js',
        //         'node_modules/foundation-sites/js/foundation.util.motion.js',
        //         'node_modules/foundation-sites/js/foundation.util.triggers.js',
        //         'node_modules/foundation-sites/js/foundation.reveal.js',
        //     ],
        //     'public/js/vendor/foundation.js',
        //     '.',
        //     {
        //         // The default options exclude everything in the node_modules folder (https://github.com/JeffreyWay/laravel-elixir-webpack-official/blob/master/src/index.js)
        //         module: {
        //             loaders: [{ test: /\.js$/, loader: 'buble' }] 
        //         }
        //     }
        // )
        .copy(
            'node_modules/foundation-sites/dist/js/foundation.min.js',
            'public/js/vendor/foundation.js'
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

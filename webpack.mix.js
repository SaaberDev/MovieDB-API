const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .styles([
        'resources/_assets/css/style.css',
        'resources/_assets/css/custom.css',
    ], 'public/_assets/css/style.css')
    .scripts([
        'resources/_assets/js/jquery-1.11.1.min.js',
        'resources/_assets/js/plugins.js',
        'resources/_assets/js/app.js',
    ],'public/_assets/js/script.js')
    .copyDirectory('resources/_assets/images', 'public/_assets/images')
    .copyDirectory('resources/_assets/fonts', 'public/_assets/fonts');

if (mix.inProduction()) {
    mix.version();
}

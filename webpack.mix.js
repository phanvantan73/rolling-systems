const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/js/plugins/moment.min.js', 'public/js/moment.min.js')
    .copy('resources/js/plugins/fullcalendar.min.js', 'public/js/fullcalendar.min.js')
    .copy('resources/sass/plugins/fullcalendar.css', 'public/css/fullcalendar.css')
    .copy('resources/js/plugins/Chart.bundle.min.js', 'public/js/Chart.bundle.min.js');

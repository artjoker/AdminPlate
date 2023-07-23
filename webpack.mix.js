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
    .vue({ version: 2 })
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

/*
 |--------------------------------------------------------------------------
 | Backend
 |--------------------------------------------------------------------------
 |
 */
function backend(mix) {

    mix.copy('resources/assets/css', 'public/assets/css');
    mix.copy('resources/assets/img', 'public/assets/img');
    mix.copy('resources/assets/js', 'public/assets/js');

    // sweetalert
    mix.copy('node_modules/sweetalert/dist/', 'public/assets/plugins/sweetalert/dist/');
    // parsleyjs
    mix.copy('node_modules/parsleyjs/', 'public/assets/plugins/parsleyjs/');
    // dropzone
    mix.copy('node_modules/dropzone/', 'public/assets/plugins/dropzone/');
    // datepicker
    mix.copy('node_modules/bootstrap-datepicker/', 'public/assets/plugins/bootstrap-datepicker/');
}

backend(mix);

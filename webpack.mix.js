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

mix.setPublicPath('public')
    .setResourceRoot('resources')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .vue({ version: 3 })
    .extract()
    .version()
    .sourceMaps();

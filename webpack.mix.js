const mix = require('laravel-mix');
require('laravel-mix-blade-reload');

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

mix.sass('resources/css/styles.scss', 'public/css');

mix.js('resources/js/jquery.js', 'public/js');
mix.js('resources/js/bootstrap.js', 'public/js');
mix.js('resources/js/scripts.js', 'public/js');

var LiveReloadPlugin = require('@kooneko/livereload-webpack-plugin');

mix.webpackConfig({
    plugins: [new LiveReloadPlugin()]
});

mix.bladeReload();
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

mix.js("resources/js/tabulator.js", "public/js")
    //.css("resources/sass/app.css", "public/css/app.css")
    .options({
        processCssUrls: false,
    })
    .copyDirectory("resources/json", "public/json")
    .copyDirectory("resources/fonts", "public/fonts")
    .copyDirectory("resources/images", "public/images")
    .browserSync({
        proxy: "midone-laravel.test",
        files: ["resources/**/*.*"],
    });


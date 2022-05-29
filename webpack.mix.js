const mix = require("laravel-mix");
require("dotenv").config();
const path = require('path');

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

mix.js("resources/js/app.js", "public/js").vue({ version: 2 }).postCss(
    "resources/css/app.css",
    "public/css", [require("tailwindcss")]
);


mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
            '~': path.resolve(__dirname, 'resources/components'),
        },
    },
});



mix.options({
    hmrOptions: {
        host: 'localhost', // site's host name
        port: 8080,
    }
});
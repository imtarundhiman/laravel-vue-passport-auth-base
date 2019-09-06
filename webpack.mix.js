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

mix.webpackConfig({    
    resolve: {      
        alias: {
            '@': __dirname + '/resources/js',
            '@static': __dirname + '/resources/assets/static',   
            '@components': __dirname + '/resources/js/components',
            '@helpers': __dirname + '/resources/js/helpers' 
        },    
    },  
});

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.copy('resources/assets/static', 'public/static');

mix.disableNotifications();

mix.version();

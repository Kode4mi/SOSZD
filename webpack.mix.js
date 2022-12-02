const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/alpine.js', 'public/js')
mix.js('resources/js/desktop.js', 'public/js')

mix.sass('resources/sass/app.scss', 'public/css')
mix.sass('resources/sass/main.scss', 'public/css')


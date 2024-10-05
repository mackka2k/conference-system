const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/scss/app.scss', 'public/css')
   .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
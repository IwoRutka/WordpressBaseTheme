// webpack.mix.js

let mix = require('laravel-mix');

mix.js('src/app.js', 'js/app.js')
   .sass('src/app.scss', 'css/app.css')
//    .browserSync({
//     proxy: {
//         target: 'http://localhost/'
//     },
//     open: false
// });
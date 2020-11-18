const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/admin/js')

   .sass('resources/sass/app.scss', 'public/admin/css')

//    .sass('resources/sass/pdf/contract.scss', 'public/admin/css/pdf')

//    .sass('resources/sass/pdf/invoice.scss', 'public/admin/css/pdf')

//    .sass('resources/sass/pdf/receipt.scss', 'public/admin/css/pdf')

  //  .sass('resources/sass/pdf/hr_letter.scss', 'public/admin/css/pdf')

//    .sass('resources/sass/emails-style/main.scss', 'public/emails-style')

   .sass('resources/sass/main-rtl.scss', 'public/admin/css');

//    .options({

//         postCss: [

//             require('autoprefixer')({

//                 browsers: ['last 40 versions'],

//             })

//         ]

//     });



// mix.js('resources/js/app-laravel.js', 'public/js/app-laravel.js');



if (!mix.inProduction()) {

    mix.webpackConfig({

        devtool: 'source-map'

    })

    .sourceMaps()

}


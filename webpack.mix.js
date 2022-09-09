/* eslint-disable @typescript-eslint/no-var-requires */
/* eslint-disable no-undef */

const mix = require('laravel-mix');

mix.css('./src/css/styles.css', './dist/css/styles.css');
mix.ts('./src/ts/app.ts', './dist/js/app.js');
mix.js('./src/ts/components.ts', './dist/js/components.js').react();

mix.webpackConfig({
    resolve: {
        extensions: ['.ts', '.js']
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                loader: 'ts-loader',
                exclude: /node_modules/
            }
        ]
    }
});

mix.options({
    terser: {
        extractComments: false
    },
    manifest: false,
    clearConsole: false
});

mix.extract();

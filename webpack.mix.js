const mix = require("laravel-mix");
const BrowSerSynPlugin = require("browser-sync-webpack-plugin");

mix.webpackConfig({
    plugins: [
        new BrowSerSynPlugin(
            {
                file: ["**/*.css"],
            },
            { reload: false }
        ),
    ],
});

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

mix.js("resources/js/app.js", "public/js")
    .vue()
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
    ])
    .alias({
        "@": "resources/js",
    });

if (mix.inProduction()) {
    mix.version();
}

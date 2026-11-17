const mix = require('laravel-mix');

/*
 | Laravel Mix: compiles Stylus into public/css and bundles the jQuery
 | modules into public/js. `mix.version()` adds cache-busting hashes that
 | Blade resolves through the mix() helper.
 */
mix.js('resources/js/app.js', 'public/js')
    .stylus('resources/stylus/app.styl', 'public/css')
    // jQuery 4 ships an ESM build: provide its default export, not the module namespace.
    .webpackConfig((webpack) => ({
        plugins: [new webpack.ProvidePlugin({ $: ['jquery', 'default'], jQuery: ['jquery', 'default'] })],
    }))
    .options({ processCssUrls: false })
    .disableNotifications()
    .version();

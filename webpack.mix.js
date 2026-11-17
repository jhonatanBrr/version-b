const mix = require('laravel-mix');

/*
 | Laravel Mix: compiles Stylus into public/css and bundles the jQuery
 | modules into public/js. `mix.version()` adds cache-busting hashes that
 | Blade resolves through the mix() helper.
 */
// Explicit public path: Mix otherwise infers it from the artisan file, which the
// Docker assets stage does not copy (the build would then write to /public).
mix.setPublicPath('public');

mix.js('resources/js/app.js', 'public/js')
    .stylus('resources/stylus/app.styl', 'public/css')
    // jQuery 4 ships an ESM build: provide its default export, not the module namespace.
    .webpackConfig((webpack) => ({
        plugins: [new webpack.ProvidePlugin({ $: ['jquery', 'default'], jQuery: ['jquery', 'default'] })],
    }))
    .options({ processCssUrls: false })
    .disableNotifications()
    .version();

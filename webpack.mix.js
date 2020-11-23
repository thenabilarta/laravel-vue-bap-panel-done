let mix = require("laravel-mix");

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

mix.disableNotifications();

mix.js(
  "modules/panel/resources/assets/panel-vue.js",
  "public/modules/panel/js"
);

mix.js(
  "modules/display/resources/assets/display-vue.js",
  "public/modules/display/js"
);

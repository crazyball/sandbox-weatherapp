var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addEntry('js/app', './assets/js/weatherapp.js')
    .addStyleEntry('css/app', './assets/css/weatherapp.css')
;

module.exports = Encore.getWebpackConfig();

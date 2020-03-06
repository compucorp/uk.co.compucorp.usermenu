'use strict';

var gulp = require('gulp');
var civicrmScssRoot = require('civicrm-scssroot')();

module.exports = function (done) {
  gulp.watch('scss/**/*.scss')
    .on('change', gulp.series('sass'));
  gulp.watch(civicrmScssRoot.getWatchList())
    .on('change', gulp.series('sass'));

  done();
};

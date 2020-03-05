'use strict';

var gulp = require('gulp');

var sassTask = require('./gulp-tasks/sass.js');
var watchTask = require('./gulp-tasks/watch.js');

/**
 * Compiles scss into CSS counterpart
 */
gulp.task('sass', sassTask);

/**
 * Watches for scss and run sass task
 */
gulp.task('watch', watchTask);

/**
 * Default tasks
 */
gulp.task('default', gulp.parallel('sass'));

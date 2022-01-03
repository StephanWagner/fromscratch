const gulp = require('gulp');
const gulpUtil = require('gulp-util');
const gulpSass = require('gulp-sass')(require('sass'));
const gulpConcat = require('gulp-concat');
const gulpCleanCSS = require('gulp-clean-css');
const gulpTerser = require('gulp-terser');
const gulpSourcemaps = require('gulp-sourcemaps');
const gulpRename = require('gulp-rename');
const vinylSourceStream = require('vinyl-source-stream');
const browserify = require('browserify');
const babelify = require('babelify');

// CSS
var styles = [
  {
    name: 'main',
    src: ['./src/scss/main.scss'],
    srcWatch: ['./src/scss/**/*.scss'],
    dest: './css'
  },
  {
    name: 'admin',
    src: ['./src/scss/admin.scss'],
    srcWatch: ['./src/scss/admin.scss'],
    dest: './css'
  }
];

// JavaScript
var scripts = [
  {
    name: 'main',
    src: ['./src/js/main.js'],
    dest: './js'
  },
  {
    name: 'admin',
    src: ['./src/js/admin.js'],
    dest: './js'
  }
];

// Tasks
let defaultTasks = [];
let watchTasks = [];
let buildTasks = [];

// Config CSS task
for (const style of styles) {
  const cssTaskConcat = function () {
    return gulp
      .src(style.src)
      .pipe(gulpSourcemaps.init())
      .pipe(
        gulpSass({
          outputStyle: 'expanded'
        }).on('error', gulpSass.logError)
      )
      .pipe(gulpConcat(style.name + '.css'))
      .pipe(gulpSourcemaps.write('./'))
      .pipe(gulp.dest(style.dest));
  };

  // Store as a task
  gulp.task('cssTaskConcat-' + style.name, cssTaskConcat);

  // Add to default tasks
  defaultTasks.push('cssTaskConcat-' + style.name);

  // Add to watch tasks
  watchTasks.push({
    src: style.srcWatch || style.src,
    task: cssTaskConcat
  });

  const cssTaskMinify = function () {
    return gulp
      .src(style.dest + '/' + style.name + '.css')
      .pipe(gulpRename(style.name + '.min.css'))
      .pipe(gulpCleanCSS())
      .pipe(gulp.dest(style.dest));
  };

  // Store as a task
  gulp.task('cssTaskMinify-' + style.name, cssTaskMinify);

  // Add to build tasks
  buildTasks.push('cssTaskMinify-' + style.name);
}

// Config JavaScript task
for (const script of scripts) {
  const jsTaskConcat = function () {
    return browserify({
      entries: script.src,
      debug: true
    })
      .transform(babelify, { presets: ['@babel/preset-env'] })
      .bundle()
      .on('error', function (e) {
        gulpUtil.log(e);
      })
      .pipe(vinylSourceStream(script.name + '.js'))
      .pipe(gulp.dest(script.dest));
  };

  // Store as a task
  gulp.task('jsTaskConcat-' + script.name, jsTaskConcat);

  // Add to default tasks
  defaultTasks.push('jsTaskConcat-' + script.name);

  // Add to watch tasks
  watchTasks.push({
    src: script.srcWatch || script.src,
    task: jsTaskConcat
  });

  // Minify
  const jsTaskMinify = function () {
    return gulp
      .src(script.dest + '/' + script.name + '.js')
      .pipe(gulpTerser())
      .pipe(gulpRename(script.name + '.min.js'))
      .pipe(gulp.dest(script.dest));
  };

  // Store as a task
  gulp.task('jsTaskMinify-' + script.name, jsTaskMinify);

  // Add to build tasks
  buildTasks.push('jsTaskMinify-' + script.name);
}

// Watch tasks
function watch() {
  for (const watchTask of watchTasks) {
    gulp.watch(watchTask.src, watchTask.task);
  }
}

// Exports
exports.default = gulp.series(defaultTasks);
exports.watch = gulp.series(defaultTasks, watch);
exports.build = gulp.series(defaultTasks, buildTasks);

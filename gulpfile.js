const gulp = require('gulp');
const fancyLog = require('fancy-log');
const gulpSass = require('gulp-sass')(require('sass'));
const gulpConcat = require('gulp-concat');
const gulpCleanCSS = require('gulp-clean-css');
const gulpTerser = require('gulp-terser');
const gulpSourcemaps = require('gulp-sourcemaps');
const gulpRename = require('gulp-rename');
const vinylSourceStream = require('vinyl-source-stream');
const browserify = require('browserify');
const babelify = require('babelify');

var themeFolder = './themes/fromscratch';

// CSS
var styles = [
  {
    name: 'main',
    src: [themeFolder + '/src/scss/main.scss'],
    srcWatch: [themeFolder + '/src/scss/**/*.scss'],
    dest: themeFolder + '/css'
  },
  {
    name: 'admin',
    src: [themeFolder + '/src/scss/admin.scss'],
    srcWatch: [themeFolder + '/src/scss/**/*.scss'],
    dest: themeFolder + '/css'
  }
];

// JavaScript
var scripts = [
  {
    name: 'main',
    src: [themeFolder + '/src/js/main.js'],
    srcWatch: [themeFolder + '/src/js/**/*.js'],
    dest: themeFolder + '/js'
  },
  {
    name: 'admin-block-options',
    src: [themeFolder + '/src/js/admin/block-options.js'],
    srcWatch: [themeFolder + '/src/js/admin/block-options.js', themeFolder + '/config-block-options.js'],
    dest: themeFolder + '/js'
  },
  {
    name: 'admin',
    src: [themeFolder + '/src/js/admin.js'],
    srcWatch: [themeFolder + '/src/js/**/*.js'],
    dest: themeFolder + '/js'
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
      .transform(babelify, { presets: ['@babel/preset-env', '@babel/preset-react'] })
      .bundle()
      .on('error', function (e) {
        fancyLog(e);
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

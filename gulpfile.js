var gulp = require('gulp');
var gulpSass = require('gulp-sass');
var gulpCleanCSS = require('gulp-clean-css');
var gulpConcat = require('gulp-concat');
var gulpRename = require('gulp-rename');
var gulpUglify = require('gulp-uglify');
var gulpSourcemaps = require('gulp-sourcemaps');
var gulpBabel = require('gulp-babel');

// CSS
var styles = [
  {
    name: 'main',
    src: [
      './src/scss/main.scss'
    ],
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
    name: 'vendor',
    src: ['./node_modules/jquery/dist/jquery.js'],
    dest: './js'
  },
  {
    name: 'main',
    src: ['./src/js/main.js'],
    dest: './js'
  }
];

// Config tasks
let defaultTasks = [];
let watchTasks = [];

// Config CSS task
for (const item of styles) {
  const cssTask = function () {
    return gulp
      .src(item.src)
      .pipe(gulpSourcemaps.init())
      .pipe(
        gulpSass({
          outputStyle: 'expanded'
        }).on('error', gulpSass.logError)
      )
      .pipe(gulpConcat(item.name + '.css'))
      .pipe(gulpSourcemaps.write('./'))
      .pipe(gulp.dest(item.dest))
      .pipe(gulpRename(item.name + '.min.css'))
      .pipe(gulpCleanCSS())
      .pipe(gulp.dest(item.dest));
  };

  // Store as a task
  gulp.task('cssTask-' + item.name, cssTask);

  // Add to default tasks
  defaultTasks.push('cssTask-' + item.name);

  // Add to watch tasks
  watchTasks.push({
    src: item.srcWatch || item.src,
    task: cssTask
  });
}

// Config JavaScript task
for (let item of scripts) {
  // Concat
  const jsTaskConcat = function () {
    return gulp
      .src(item.src)
      .pipe(gulpSourcemaps.init())
      .pipe(
        gulpBabel({
          presets: ['@babel/env']
        })
      )
      .pipe(gulpConcat(item.name + '.js'))
      .pipe(gulpSourcemaps.write('./'))
      .pipe(gulp.dest(item.dest));
  };

  // Store as a task
  gulp.task('jsTaskConcat-' + item.name, jsTaskConcat);

  // Add to default tasks
  defaultTasks.push('jsTaskConcat-' + item.name);

  // Add to watch tasks
  watchTasks.push({
    src: item.src,
    task: jsTaskConcat
  });

  // Minify
  const jsTaskMinify = function () {
    return gulp
      .src(item.src)
      .pipe(
        gulpBabel({
          presets: ['@babel/env']
        })
      )
      .pipe(gulpRename(item.name + '.min.js'))
      .pipe(gulpUglify())
      .pipe(gulp.dest(item.dest));
  };

  // Store as a task
  gulp.task('jsTaskMinify-' + item.name, jsTaskMinify);

  // Add to default tasks
  defaultTasks.push('jsTaskMinify-' + item.name);

  // Add to watch tasks
  watchTasks.push({
    src: item.src,
    task: jsTaskMinify
  });
}

// Watch tasks
function watch() {
  for (const watchTask of watchTasks) {
    gulp.watch(watchTask.src, watchTask.task);
  }
}

exports.default = gulp.series(defaultTasks);
exports.watch = gulp.series(defaultTasks, watch);
exports.build = gulp.series(defaultTasks);

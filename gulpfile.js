//const del = require('del');
const gulp = require('gulp');
const gulpUtil = require('gulp-util');
const gulpSass = require('gulp-sass')(require('sass'));
const gulpCleanCSS = require('gulp-clean-css');
const gulpTerser = require('gulp-terser');
const gulpSourcemaps = require('gulp-sourcemaps');
const gulpRename = require('gulp-rename');
//const gulpFileInclude = require('gulp-file-include');
const vinylSourceStream = require('vinyl-source-stream');
const browserify = require('browserify');
//const browserSync = require('browser-sync').create();
const babelify = require('babelify');

// var styles = [
//   {
//     name: 'main',
//     src: ['./src/scss/main.scss'],
//     srcWatch: ['./src/scss/**/*.scss'],
//     dest: './css'
//   },
//   {
//     name: 'admin',
//     src: ['./src/scss/admin.scss'],
//     srcWatch: ['./src/scss/admin.scss'],
//     dest: './css'
//   }
// ];

// // Compile CSS
// gulp.task('css', function () {
//   return gulp
//     .src('./src/scss/index.scss')
//     .pipe(gulpSourcemaps.init())
//     .pipe(gulpSass())
//     .on('error', gulpSass.logError)
//     .pipe(gulpSourcemaps.write())
//     .pipe(gulpRename('main.css'))
//     .pipe(gulp.dest('./dist/css'));
// });

// // Build CSS
// gulp.task('css-build', function () {
//   return gulp
//     .src('./dist/css/main.css')
//     .pipe(gulpCleanCSS())
//     .pipe(gulpRename('main.min.css'))
//     .pipe(gulp.dest('./dist/css'));
// });

// // Compile JavaScript
// gulp.task('js', function () {
//   return browserify({
//     entries: './src/js/index.js',
//     debug: true
//   })
//     .transform(babelify, { presets: ['@babel/preset-env'] })
//     .bundle()
//     .on('error', function (e) {
//       gulpUtil.log(e);
//     })
//     .pipe(vinylSourceStream('main.js'))
//     .pipe(gulp.dest('./dist/js'));
// });

// // Build JavaScript
// gulp.task('js-build', function () {
//   return gulp
//     .src('./dist/js/main.js')
//     .pipe(gulpTerser())
//     .pipe(gulpRename('main.min.js'))
//     .pipe(gulp.dest('./dist/js'));
// });

// // Initialize dist files
// gulp.task('watch', gulp.series(gulp.parallel('css', 'js')));

// // Build for production
// gulp.task('build', gulp.series(gulp.parallel('css-build', 'js-build')));

// var gulp = require('gulp');
// var gulpSass = require('gulp-sass')(require('sass'));
// var gulpCleanCSS = require('gulp-clean-css');
var gulpConcat = require('gulp-concat');
// var gulpRename = require('gulp-rename');
// var gulpUglify = require('gulp-uglify');
// var gulpSourcemaps = require('gulp-sourcemaps');
// var gulpBabel = require('gulp-babel');

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

// Config tasks
let defaultTasks = [];
let watchTasks = [];

// Config CSS task
for (const style of styles) {
  const cssTask = function () {
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
      .pipe(gulp.dest(style.dest))
      .pipe(gulpRename(style.name + '.min.css'))
      .pipe(gulpCleanCSS())
      .pipe(gulp.dest(style.dest));
  };

  // Store as a task
  gulp.task('cssTask-' + style.name, cssTask);

  // Add to default tasks
  defaultTasks.push('cssTask-' + style.name);

  // Add to watch tasks
  watchTasks.push({
    src: style.srcWatch || style.src,
    task: cssTask
  });
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

  // Add to default tasks
  defaultTasks.push('jsTaskMinify-' + script.name);

  // Add to watch tasks
  watchTasks.push({
    src: script.srcWatch,
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

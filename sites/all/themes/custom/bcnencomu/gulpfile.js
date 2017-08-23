var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

// styles
gulp.task('styles', function() {
  gulp.src('sass/styles.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('css'));
});

//watch
gulp.task('watch', function() {
  //watch .scss files
  gulp.watch('sass/**/*.scss', ['styles']);
});

// The default task
gulp.task('default', ['styles']);
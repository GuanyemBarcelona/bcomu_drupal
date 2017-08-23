var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var sourcemaps = require('gulp-sourcemaps');
var plumber = require('gulp-plumber');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var ngAnnotate = require('gulp-ng-annotate');

// styles
gulp.task('styles', function() {
    gulp.src('sass/styles.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('assets/css'));
});

// scripts
gulp.task('scripts', function () {
    gulp.src(['app/app.module.js', 'app/components/**/*.js', 'app/shared/**/*.js'])
        .pipe(plumber())
        .pipe(concat('app.min.js'))
        .pipe(ngAnnotate())
        .pipe(uglify())
        .pipe(gulp.dest('assets/js'))
})

//watch
gulp.task('watch', function() {
    //watch .scss files
    gulp.watch('sass/**/*.scss', ['styles']);

    //watch .js files
    gulp.watch('app/**/*.js', ['scripts']);
});
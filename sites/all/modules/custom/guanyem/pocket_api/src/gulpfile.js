var gulp = require('gulp');
var plumber = require('gulp-plumber');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var ngAnnotate = require('gulp-ng-annotate');

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
    //watch .js files
    gulp.watch('app/**/*.js', ['scripts']);
});

// The default task
gulp.task('default', ['scripts']);
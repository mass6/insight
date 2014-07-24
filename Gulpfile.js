var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');

gulp.task('css', function() {
    gulp.src('app/assets/sass/main.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 versions'))
        .pipe(gulp.dest('public/css'));
});

gulp.task('minify', function(){
    gulp.src('public/css/main.css')
        .pipe(minifycss())
        .pipe(gulp.dest('public/css/min'));
});

gulp.task('watch', function(){
    gulp.watch('app/assets/sass/**/*.scss', ['css', 'minify']);
});

gulp.task('default', ['watch']);
'use strict';

let gulp = require('gulp'),
    sass = require('gulp-sass'),
    rename = require('gulp-rename'),
    cleanCSS = require('gulp-clean-css'),
    plumber = require('gulp-plumber'),
    postcss = require('gulp-postcss'),
    cssNano = require('cssnano'),
    autoprefixer = require('autoprefixer'),
    maps = require('gulp-sourcemaps'),
    browserSync = require('browser-sync').create(),
    cfg = require('./gulpconfig.json'),
    paths = cfg.paths;

let plugins = [
    autoprefixer({browsers: ['last 2 versions']}),
    cssNano()
]

gulp.task('minify-css', () => {
    return gulp.src( paths.css + '/style.css')
        .pipe(cleanCSS())
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('css/'))
});

gulp.task('sass', () => {
    return gulp.src( paths.sass + '/*.scss')
        .pipe(plumber())
        .pipe(maps.init())
        .pipe(sass.sync().on('error', sass.logError))
        //.pipe(maps.write({includeContent: false}))
        //.pipe(maps.init({loadMaps: true}))
        .pipe(postcss(plugins))
        .pipe(rename('style.css'))
        .pipe(maps.write())
        .pipe(gulp.dest(paths.css))
        .pipe(browserSync.stream()) // Inject Styles
});

gulp.task('admin-styles', () => {
    return gulp.src( './admin-colors/sfbase/*.scss')
        .pipe(plumber())
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(rename('colors.min.css'))
        .pipe(gulp.dest(paths.adminColors))
});

gulp.task('setup', () => {
    /* jQuery */
    gulp.src( paths.node + '/jquery/dist/jquery.min.js')
        .pipe(plumber())
        .pipe(gulp.dest('./js/jquery'));

    /* Bootstrap */
    gulp.src( paths.node + '/@popperjs/core/dist/umd/popper.min.js')
        .pipe(plumber())
        .pipe(gulp.dest('./js/bootstrap'));
    gulp.src( paths.node + '/bootstrap/dist/js/bootstrap.min.js')
        .pipe(plumber())
        .pipe(gulp.dest('./js/bootstrap'));
    gulp.src( paths.node + '/bootstrap/scss/**/*.scss')
        .pipe(plumber())
        .pipe(gulp.dest('./sass/bootstrap5'));

    /* Slick Slider
    gulp.src( paths.node + '/@glidejs/glide/dist/glide.js')
        .pipe(plumber())
        .pipe(gulp.dest('./js/glide'));
    gulp.src( paths.node +'/@glidejs/glide/dist/glide.min.js')
        .pipe(plumber())
        .pipe(gulp.dest('./js/glide'));
    gulp.src( paths.node + '/@glidejs/glide/dist/css/glide.core.min.css')
        .pipe(plumber())
        .pipe(gulp.dest('./js/glide/css'));
    gulp.src( paths.node + '/@glidejs/glide/dist/css/glide.theme.css')
        .pipe(plumber())
        .pipe(gulp.dest('./js/glide/css'));
     */

    /* Font Awesome
    gulp.src( paths.node + '/@fortawesome/fontawesome-free/js/all.min.js')
        .pipe(plumber())
        .pipe(gulp.dest('./js/fontawesome'));
     */
});

gulp.task('browser-sync', () => {

    browserSync.init(cfg.browserSyncWatchFiles, cfg.browserSyncOptions);

});

gulp.task('watch', () => {
    gulp.watch('sass/**/*.scss', ['sass']);
});

gulp.task('default', ['sass','browser-sync','watch']);
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    browserSync = require('browser-sync').create();

var DEST = 'build/';

gulp.task('scripts', function() {
    return gulp.src([
        'docs/js/helpers/*.js',
        'docs/js/*.js',
      ])
      .pipe(concat('custom.js'))
      .pipe(gulp.dest(DEST+'/js'))
      .pipe(rename({suffix: '.min'}))
      .pipe(uglify())
      .pipe(gulp.dest(DEST+'/js'))
      .pipe(browserSync.stream());
});

// TODO: Maybe we can simplify how sass compile the minify and unminify version
var compileSASS = function (filename, options) {
  return sass('docs/scss/*.scss', options)
        .pipe(autoprefixer('last 2 versions', '> 5%'))
        .pipe(concat(filename))
        .pipe(gulp.dest(DEST+'/css'))
        .pipe(browserSync.stream());
};

gulp.task('sass', function() {
    gulp.src('docs/scss/**/*.scss')
    .pipe(cache( 'sass' ))
    .pipe(plumber())
    .pipe(sass({
        outputStyle: 'expanded',
        indentType: 'Tab',
        indentWidth: '1'
    }))
    .pipe(plumber({
        errorHandler: notify.onError("Error: <%= error.message %>")
    }))
    //出力先指定
    .pipe(gulp.dest('build/css/'))
    .pipe(browserSync.reload({strem:true}));
    return compileSASS('custom.css', {});
});

gulp.task('sass-minify', function() {
    return compileSASS('custom.min.css', {style: 'compressed'});
});

gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: './'
        },
        startPath: './production/index.php'
    });
});

gulp.task('watch', function() {
  // Watch .html files
  gulp.watch('production/*.html', browserSync.reload);
  // Watch .php files
  gulp.watch('production/*.php', browserSync.reload);
  // Watch .js files
  gulp.watch('docs/js/*.js', ['scripts']);
  // Watch .scss files
  gulp.watch('docs/scss/*.scss', ['sass', 'sass-minify']);
});

// Default Task
gulp.task('default', ['browser-sync', 'watch']);

gulp.task('connect-sync', function() {
    connect.server({
        port:80,
        base:'./'
    },function(){
        browserSync({
            proxy: 'vagrant.mamp/stu_sql/cakes/gentelella/gentelella-master-custom/'
        });
    });
});
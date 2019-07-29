var gulp = require('gulp');
var sass = require('gulp-sass');

//Função para compilar o SASS
gulp.task('sass', gulp.series(function () {
  return gulp.src([
      'node_modules/bootstrap/scss/*.scss',
      'node_modules/normalize-css/normalize.css',
      'node_modules/animate.css/animate.min.css'
    ])
    .pipe(sass())
    .pipe(sass({
      outputStyle: 'compressed'
    }).on('error', sass.logError))
    .pipe(gulp.dest('src/css'))
}));

//Função para mover o JS
gulp.task('js', gulp.series(function () {
  return gulp.src([
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/popper.js/dist/umd/popper.min.js',
      'node_modules/wowjs/dist/wow.min.js'
    ])
    .pipe(gulp.dest('src/js'))
}));

// gulp.task('default', gulp.series(['sass', 'js' ,'watch']));
gulp.task('default', gulp.series(['sass', 'js']));
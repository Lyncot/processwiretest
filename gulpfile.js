var gulp = require('gulp'),
	uglify = require('gulp-uglify'),
	del = require('del'),
	cssnano = require('gulp-cssnano'),
	concat = require('gulp-concat'),
	sass = require('gulp-sass')(require('sass')),
	sourcemaps = require('gulp-sourcemaps'),
	rename = require('gulp-rename'),
	imagemin = require('gulp-imagemin'),
	imageminMozjpeg = require('imagemin-mozjpeg'),
	imageminPngquant = require('imagemin-pngquant'),
	imageminWebp = require('imagemin-webp'),
	extReplace = require("gulp-ext-replace"),
	browserSync = require('browser-sync').create();

// Load in local config
require('../nub.js');
var project = {
	name : 'Process Wire Test',
	user : $user,
	dir : 'processwiretest'
};

// Configure working directories
var dirs = {
	dist : 'dist/'
};

// Configure the file structure
var files = {
	 all: ['**/*', '!**/docs/', '!**/docs/**', '!**/global.php', '!**/bottomscript.php', '!**/scss/', '!**/scss/**', '!**/node_modules/', '!**/node_modules/**', '!**/cdist/', '!**/cdist/**', '!**/package.json', '!**/*.sublime-project', '!**/*.sublime-workspace', '!**/.DS_Store', '!**/php.ini', '!**/gulpfile.js', '!**/dev-build/', '!**/dev-build/**'],
	 html: ['**/*.php', '!**/docs/', '!**/docs/**', '**/*.html', '!**/node_modules/**', '!**/cdist/**', '!**/global.php', '!**/bottomscript.php'],
	 js: ['js/**/*.js'],
	 css: ['css/**/*.css'],
	 img: ['img/**/*.png', 'img/**/*.jpg'],
	 svg: 'img/**/*.svg',
	 vid: ['vid/**/*.mp4', 'vid/**/*.webm', 'vid/**/*.ogg'],
	 fonts: ['fonts/**'],
	 webfonts: ['webfonts/*.eot', 'webfonts/*.svg', 'webfonts/*.ttf', 'webfonts/*.woff', 'webfonts/*.woff2', 'webfonts/*.otf'],
	 json: ['**/*.json', "!**/package.json", "!**/package-lock.json", '!**/node_modules/**']
};

// Paths to node modules
var paths = {
	zurb : 'node_modules/foundation-sites/scss',
	motionui : 'node_modules/motion-ui/src',
	jquery : 'node_modules/jquery/dist/jquery.js',
	jqueryUI : 'js/vendor/jquery/jqueryui/jquery-ui.js',
	equalizer : 'js/vendor/jquery/equalize/equalize.js',
	jqueryUnveil : 'js/vendor/jquery/unveil/jquery.unveil.js',
	jqueryValidate : 'node_modules/jquery-validation/dist/jquery.validate.js',
	slick : 'js/vendor/slick/',
	fontAwesome : 'node_modules/@fortawesome/fontawesome-pro'
}

//Set up BrowserSync Server
gulp.task('browserSync', function(done) {
  browserSync.init({
    proxy: `http://localhost/${project.user}` + project.dir
  })

  done();
});

// Font Awesome - Install Font Files
gulp.task('fontAwesome', function() {
	return gulp.src(paths.fontAwesome + '/webfonts/**.*')
	.pipe(gulp.dest('./webfonts/'));
});

// Compile SASS to CSS
gulp.task('compileSass', function() {
	return gulp.src('scss/**/*.scss', {allowEmpty: true})
	.pipe(sourcemaps.init())
		.pipe(sass({includePaths: [paths.zurb, paths.motionui, paths.fontAwesome + '/scss']}).on('error', sass.logError))
	.pipe(sourcemaps.write())
	.pipe(gulp.dest('./site/templates/styles/'))
	.pipe(browserSync.stream());
});

//Compile & Shrink SASS
gulp.task('shrinkSass', function() {
	return gulp.src('scss/**/*.scss', {allowEmpty: true})
	.pipe(sass({includePaths: [paths.zurb, paths.motionui, paths.fontAwesome + '/scss']}).on('error', sass.logError))
	.pipe(cssnano())
	.pipe(gulp.dest('./site/templates/styles/'))
	.pipe(browserSync.stream());
});

//Combine Javascript Files
gulp.task('concatJs', function() {
	return gulp.src([paths.jquery, paths.jqueryUI, paths.jqueryUnveil, paths.equalizer, paths.jqueryValidate, paths.slick + 'slick.js', paths.slick + '/**/*.js', 'js/legal/*.js','js/nquire/**/*.js' , 'js/app/**/*.js'])
	.pipe(concat('app.js'))
	.pipe(gulp.dest('site/templates/scripts/'));
});

//Minify Javascript with UglifyJS
gulp.task('minifyScripts', gulp.series('concatJs', function() {
	return gulp.src('js/app.js')
	.pipe(uglify())
	.pipe(rename('app.min.js'))
	.pipe(gulp.dest('js'));
}));

//Minify Images
gulp.task('imgMini', () =>
    gulp.src(files.img)
    .pipe(imagemin([
	imagemin.mozjpeg({quality: 80}), 
    imageminMozjpeg({
    	quality: 70
    }),
    imageminPngquant({
    	quality: [0.8, 0.9],
    	floyd: 0.6,
    	speed: 5
    }),
    ], {
    verbose: true
    }))
    .pipe(gulp.dest(dirs.dist + 'img/'))
);

//Convert Images to WebP Format
gulp.task('webp', function() {
	gulp.src(['img/*.jpg', 'img/*.png'])
	.pipe(imagemin([
		imageminWebp({
			quality: 70
		})
		],{
	        verbose: true
        }))
    .pipe(extReplace(".webp"))
	.pipe(gulp.dest(dirs.dist + 'img/webp/'))
}); 

// Clean out the dist directory
gulp.task('clean', function() {
	return del([
		dirs.dist
	]);
});

//Create dist project files
gulp.task('dist', gulp.series('shrinkSass', 'minifyScripts', 'clean', 'imgMini', function(done) {
	// Copy html / php
	gulp.src(files.html,{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist));

	// Copy CSS
	gulp.src(files.css,{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist + 'css/'));

	// Add minified app.js
	gulp.src('js/app.min.js',{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist + 'js/'));

	// Copy SVG Images
	gulp.src(files.svg,{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist + 'img/'));

	// Copy video
	gulp.src(files.vid,{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist + 'vid/'));

	// Copy Fonts
	gulp.src(files.fonts,{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist + 'fonts/'));

	// Copy webfonts
	gulp.src(files.webfonts,{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist + 'webfonts/'));

	// Copy JSON
	gulp.src(files.json,{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist));

	// Copy live configuration versions into dist 
	gulp.src('live/**/*.php',{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist + 'inc/'));

	// Copy live .htaccess file
	gulp.src('live/**/.htaccess',{allowEmpty: true})
	.pipe(gulp.dest(dirs.dist));

	done();
}));

// Reload Browsers
gulp.task('refresh', function(done) {
    browserSync.reload();
    done();
});

//Sass Watch task
gulp.task('watch', gulp.series('browserSync', 'compileSass', 'fontAwesome', function(done) {
    gulp.watch('scss/**/*.scss', gulp.series('compileSass'));
    gulp.watch('**/*.php', gulp.series('refresh'));

    done();
}));
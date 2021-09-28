/**
 * ------------------------------------------------------------
 * Package Definitions
 * ------------------------------------------------------------
 */
let cwd = process.cwd(),

    // Require all gulp modules
    fs = require('fs'),
    path = require('path'),
    del = require('del'),

    gulp = require('gulp'),
    runSequence = require('run-sequence'),
    argv = require('yargs').argv,
    spawn = require('child_process').spawn,
    gutil = require('gulp-util'),
    browserSync = require('browser-sync').create(),

    autoprefixer = require('gulp-autoprefixer'),
    babel = require('gulp-babel'),
    cache = require('gulp-cache'),
    concat = require('gulp-concat'),
    cssnano = require('gulp-cssnano'),
    htmlmin = require('gulp-htmlmin'),
    imagemin = require('gulp-imagemin'),
    notify = require('gulp-notify'),
    rename = require('gulp-rename'),
    rev = require('gulp-rev'),
    sass = require('gulp-sass'),
		sassGlob = require('gulp-sass-glob'),
    sourcemaps = require('gulp-sourcemaps'),
    svgstore = require('gulp-svgstore'),
		svgmin = require('gulp-svgmin'),
		uglify = require('gulp-uglify'),
		wpPot = require('gulp-wp-pot'),

    // Bring whole package.json into Gulp
    // so we can reference it at will
    pkg = require( './package.json' ),
    globs = pkg.globs;

    // Set SASS compoiler version to use.
    sass.compiler = require('node-sass');

/**
 * ------------------------------------------------------------
 * Function Definitions
 * ------------------------------------------------------------
 */

/**
 * Get the names of subfolders of a parent folder.
 * @param  {String} dir The parent folder path.
 * @return {Array}      An array of the folder names found.
 */
let getFolders = ( dir ) => {
  return fs.readdirSync( dir )
    .filter( ( file ) => {
      return fs.statSync( path.join( dir, file ) ).isDirectory();
    } );
};

/**
 * ------------------------------------------------------------
 * Level 1 (Base) Tasks
 * These tasks should be thought of as building blocks
 * to build more complex tasks from.
 * ------------------------------------------------------------
 */

/**
 * Delete all files and folders from the /dist directory.
 * Files which are not part of the build process will be preserved.
 */
gulp.task( 'clean', () => {
  let preserve = [
    'dist/.git',
    'dist/.gitignore',
    'dist/.keep',
    'dist/.htaccess',
    'dist/README.md'
  ];

  /**
   * Prepend ! to each preserved item to fit exclude format for del plugin.
   * @see https://github.com/sindresorhus/multimatch#globbing-patterns
   */
  preserve = preserve.map( (item) => '!' + item );

  return del( ['dist/**/*'].concat( preserve ) );
} );


gulp.task( 'wppot', () => {
	return gulp.src( '**/*.php' )
		.pipe( wpPot( {
			domain: 'taylor-cole',
			package: 'Taylor Cole'
		} ) )
		.pipe(gulp.dest( 'languages/taylor-cole.pot' ));
} );

/**
 * Process all Sass (.scss) files into CSS.
 *
 * Uses autoprefixer for browser prefixes:
 *   Last 2 major versions of browsers,
 *   Any browser that has more than 5% global usage
 *   IE 9, 10 & 11 specifically
 *
 * Creates:
 *     Main .css file
 *     Minified .min.css file
 *     Sourcemap for minified file
 */
gulp.task( 'styles', () => {
  return gulp.src( globs.styles.in )
    .pipe( sassGlob() )
    .pipe( sourcemaps.init() )
		.pipe( sass().on('error', sass.logError) )
    //.pipe(sourcemaps.write())
    .pipe( autoprefixer( {
      browsers: ['last 2 versions', '> 5%', 'IE 10', 'IE 11']
    } ) )
    .pipe( gulp.dest( globs.styles.out ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( cssnano( {
      autoprefixer: false,
      mergeIdents: false
    } ) )
    .pipe( gulp.dest( globs.styles.out ) )
    .pipe( sourcemaps.write('maps') )
    .pipe( gulp.dest( globs.styles.out ) )
    .pipe( browserSync.stream() )
    .pipe( notify( { message: 'Styles task complete', onLast: true } ) );
} );

/**
 * Process each subfolder of the scripts folder,
 * into a single combined file per folder.
 *
 * Uses promises to know when each individual
 * folder has been fully processed.
 *
 * Creates:
 *     Single .js folder per subfolder
 *     Single .min.js minified file per subfolder
 *     Sourcemap for each minified file created
 */
gulp.task( 'scripts', () => {
  let promises = [];

  getFolders( globs.scripts.in ).map( function( folder ) {

    // Generate a promise per folder, resolved when stream ends
    let _promise = new Promise( (resolve, reject) => {

      gulp.src( path.join( globs.scripts.in, folder, '/*.js' ) )
        .pipe( sourcemaps.init() )
        .pipe( babel() )
        .pipe( concat( folder + '.js' ) )
        .pipe( gulp.dest( globs.scripts.out ) )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( uglify() )
        .pipe( gulp.dest( globs.scripts.out ) )
        .pipe( sourcemaps.write('maps') )
        .pipe( gulp.dest( globs.scripts.out ) )
        .on( 'end', resolve )
        .pipe( notify( { message: 'Scripts task [' + folder + '] complete', onLast: true } ) );

    } );

    promises.push( _promise );

  } );

  Promise.all( promises ).then( () => {
    browserSync.reload();
  } );

  return Promise.all( promises );
} );

/**
 * Add a version string to any CSS/JS assets referenced in the HTML files.
 * The version strings are written to a .json file in the output directory.
 */
gulp.task( 'create-revisions', () => {
  return gulp.src( globs.createRevisions.in )
    .pipe( rev() )
    .pipe( gulp.dest( globs.createRevisions.out ) )
    .pipe( rev.manifest() )
    .pipe( gulp.dest( globs.createRevisions.out ) )
    .pipe( browserSync.stream() );
} );

/**
 * Optimise each image in the project.
 * Does not run on `watch` due to crashing the watch task as files are saved.
 *
 * Because images change infrequently, a workaround is to
 * open a separate terminal window and use that solely for
 * running the images task as and when needed.
 */
gulp.task( 'images', () => {
  return gulp.src( globs.images.in )
    .pipe( cache( imagemin( { optimizationLevel: 5, progressive: true, interlaced: true } ) ) )
    .pipe( gulp.dest( globs.images.out ) )
    .pipe( notify( { message: 'Images task complete', onLast: true } ) );
} );

/**
 * SVG
 *
 * Optimise all svg files.
 */
gulp.task('svg', function () {
  return gulp.src( globs.svg.in )
  .pipe(svgmin(function (file) {
      return {
				plugins: [{
					removeUselessDefs: false
				},
				{
					cleanupIDs: false
				}]
      }
    }))
  .pipe(gulp.dest( globs.svg.out ))
  .pipe( notify( { message: 'SVG task complete', onLast: true } ) );
});

/**
 * Optimise each image in the project.
 * Does not run on `watch` due to crashing the watch task as files are saved.
 *
 * Because images change infrequently, a workaround is to
 * open a separate terminal window and use that solely for
 * running the images task as and when needed.
 */
gulp.task( 'fonts', () => {
  return gulp.src( globs.fonts.in )
    .pipe( gulp.dest( globs.fonts.out ) )
    .pipe( notify( { message: 'Fonts task complete', onLast: true } ) );
} );

/**
 * Start the local develpment server.
 * Should run by default on http://localhost:3000/
 * but URL will be displayed in terminal output.
 */
gulp.task( 'server', ( done ) => {
  browserSync.init( {
    proxy: 'https://www.taylorcole.test/',
    // Don't mirror clicks, scroll across instances
    ghostMode: false,
    // Don't open straight away (most likely already have
    // a tab running so this causes duplication)
    open: false
  } );

  done();
} );

gulp.task( 'server-reload', ( done ) => {
  browserSync.reload();
  done();
} );


/**
 * ------------------------------------------------------------
 * Level 2 (Combined) Tasks
 * Built up of sequences of the Level 1 tasks.
 * ------------------------------------------------------------
 */

/**
 * Start watching for changes to source files.
 * Any changes will cause the associated task to be run.
 */
gulp.task( 'watch', ( done ) => {
  // Watch style files
  gulp.watch( globs.styles.watch, ['styles'] ).on( 'error', (error) => {
    gutil.log( error.toString() );
  } );

  // Watch script files
  gulp.watch( globs.scripts.watch, ['scripts'] ).on( 'error', (error) => {
    gutil.log( error.toString() );
  } );

  // Watch svg files
  gulp.watch( globs.svg.watch, ['svg'] ).on( 'error', (error) => {
    gutil.log( error.toString() );
	} );

  // Watch svg files
  gulp.watch( globs.fonts.watch, ['fonts'] ).on( 'error', (error) => {
    gutil.log( error.toString() );
	} );

  gulp.watch( "**/*.php", ['server-reload'] ).on( 'error', (error) => {
    gutil.log( error.toString() );
  } );

  done();
} );

/**
 * Builds all of the assets of the site.
 */
gulp.task( 'build', ( done ) => {
  runSequence( [ 'styles', 'scripts', 'svg', 'images', 'fonts', 'wppot' ], done );
} );

/**
 * Converts the built assets into a production ready format.
 */
gulp.task( 'production-ready', ( done ) => {
  runSequence( 'create-revisions', done );
} );


/**
 * ------------------------------------------------------------
 * Level 3 (Complex) Tasks
 * Built up of sequences of the Level 1 & Level 2 tasks.
 * ------------------------------------------------------------
 */

/**
 * Run sequence for local development with live reloads.
 */
gulp.task( 'local', ( done ) => {
  argv.env = 'development';

  runSequence( 'clean', 'build', 'server', 'watch', done );
} );

/**
 * Run sequence for staging site.
 */
gulp.task( 'staging', ( done ) => {
  argv.env = 'development';

  runSequence( 'clean', 'build', 'production-ready', done );
} );

/**
 * Run sequence for live site.
 * Doesn't use `build` as this could allow drafts to be created.
 */
gulp.task( 'live', ( done ) => {
  argv.env = 'production';

  runSequence( 'clean', 'build', 'production-ready', done );
} );

/**
 * Set default task - local with development server.
 */
gulp.task( 'default', ( done ) => {
  gulp.start( 'local' );
  done();
} );

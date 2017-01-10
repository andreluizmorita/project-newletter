const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
    
elixir(function(mix) {
    mix.styles(
    	[
    		'../bower/bootstrap/dist/css/bootstrap.min.css',
    		'../bower/font-awesome/css/font-awesome.min.css',
    		'main.css'
    	], 
    	'public/css/styles.css');

    mix.scripts(
	    [
	    	'../bower/jquery/dist/jquery.min.js',
	    	'../bower/bootstrap/dist/js/bootstrap.min.js', 
	    	'main.js'
	    ],
	    'public/js/scripts.js'
	);
});
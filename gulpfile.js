var elixir = require('laravel-elixir');

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

//describe folder bower install
var bowers = './bower_components/';

elixir(function(mix) {
    
	mix.styles([
		bowers + 'AdminLTE/bootstrap/css/bootstrap.min.css',
        bowers + 'AdminLTE/plugins/datatables/dataTables.bootstrap.css', //datatables
		bowers + 'AdminLTE/dist/css/AdminLTE.min.css',
		bowers + 'AdminLTE/dist/css/skins/_all-skins.min.css',
    	bowers + 'font-awesome/css/font-awesome.css',
        bowers + 'summernote/dist/summernote.css',
        bowers + 'animate.css/animate.css', 
        bowers + 'chosen/chosen.css', 
        'app.css'
	], 'public/css/app.css')
	.copy([
		bowers + 'AdminLTE/bootstrap/fonts',
		bowers + 'font-awesome/fonts',
		bowers + 'summernote/dist/font',
	], 'public/fonts')
    .copy([
        bowers + 'AdminLTE/dist/img/user2-160x160.jpg',
        bowers + 'chosen/chosen-sprite.png',
		bowers + 'chosen/chosen-sprite@2x.png',
	], 'public/img')
    .scripts([
        bowers + 'jquery/dist/jquery.min.js',
		bowers + 'AdminLTE/bootstrap/js/bootstrap.js',
        bowers + 'AdminLTE/plugins/datatables/jquery.dataTables.js',
        bowers + 'AdminLTE/plugins/datatables/dataTables.bootstrap.js',
        bowers + 'summernote/dist/summernote.js',
        bowers + 'AdminLTE/dist/js/app.js',
        bowers + 'noty/js/noty/jquery.noty.js',
        bowers + 'noty/js/noty/packaged/jquery.noty.packaged.min.js',
        bowers + 'chosen/chosen.jquery.js',
		'app.js'
    ], 'public/js/app.js');
});

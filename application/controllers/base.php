<?php

class Base_Controller extends Controller {
	public $restful  = true;
	public $layout = "layouts.main";

	public function __construct()
	{	
		parent::__construct();
		
		/*** CSS Assets ***/
		Asset::add('bootstrap_css', 'library/bootstrap/css/bootstrap.min.css');
		Asset::add('bootstrap_responsive_css', 'library/bootstrap/css/bootstrap-responsive.css');
		Asset::add('elusive_css','library/elusive/css/elusive-webfont.css');
		// Asset::add('datepicker_css','library/datepicker/css/datepicker.css');
		Asset::add('datepicker_css','library/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');
		Asset::add('styles','css/styles.css');

		/*** JS Assets ***/
		Asset::add('jquery', 'library/jquery/jquery-1.9.1.min.js');
		Asset::add('bootstrap_js', 'library/bootstrap/js/bootstrap.min.js','jquery');
		// Asset::add('datepicker_script', 'library/datepicker/js/bootstrap-datepicker.js','jquery');
		Asset::add('datepicker_script', 'library/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js','jquery');
		Asset::add('js_scripts', 'js/scripts.js','jquery');
		Asset::add('jasny_bootstrap_js', 'library/jasny-bootstrap/js/jasny-bootstrap.js','jquery');
	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}
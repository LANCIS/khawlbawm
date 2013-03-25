<?php

ini_set('display_errors', 'On');

Laravel\Event::listen(Laravel\Config::loader, function($bundle, $file)
{
	return Laravel\Config::file($bundle, $file);
});

$aliases = Laravel\Config::get('application.aliases');

Laravel\Autoloader::$aliases = $aliases;

Autoloader::map(array(
	'Base_Controller' => path('app').'controllers/base.php',
));

Autoloader::directories(array(
	path('app').'models',
	path('app').'libraries',
));


Event::listen(View::loader, function($bundle, $view)
{
	return View::file($bundle, $view, Bundle::path($bundle).'views');
});


Event::listen(Lang::loader, function($bundle, $language, $file)
{
	return Lang::file($bundle, $language, $file);
});

if (Config::get('application.profiler'))
{
	Profiler::attach();
}

Blade::sharpen();

date_default_timezone_set(Config::get('application.timezone'));

if ( ! Request::cli() and Config::get('session.driver') !== '')
{
	Session::load();
}
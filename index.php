<?php

if (file_exists('vendor/autoload.php')) {
	// load via composer
	require_once('vendor/autoload.php');
	$f3 = \Base::instance();
} elseif (!file_exists('lib/base.php')) {
	die('fatfree-core not found. Run `git submodule init` and `git submodule update` or install via composer with `composer install`.');
} else {
	// load via submodule
	/** @var Base $f3 */
	$f3=require('lib/base.php');
}

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<8.0)
	trigger_error('PCRE version is out of date');

// Load configuration
$f3->config('../proclean.ini');

$f3->route('GET /',
	function($f3) {

		$f3->set('content','home.htm');
		echo View::instance()->render('layouts/layout.htm');
	}
);


$f3->route('GET /free-quote',
	function($f3) {

		$f3->set('content','free-quote.htm');
		echo View::instance()->render('layouts/layout.htm');
	}
);

$f3->route('GET /services',
	function($f3) {

		$f3->set('content','services.htm');
		echo View::instance()->render('layouts/layout.htm');
	}
);

$f3->route('GET /contact',
	function($f3) {

		$f3->set('content','contact.htm');
		echo View::instance()->render('layouts/layout.htm');
	}
);

$f3->run();

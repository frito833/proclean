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
		$f3->set('title',"Pro Clean Elite Pressure Washing - Servicing Honolulu, Hawaii");
		$f3->set('metaDescription','Pressure Washing Service in Honolulu, Hawaii. We power wash commerical, residential, cars, and boats.');

		$f3->set('content','home.htm');
		echo View::instance()->render('layouts/layout.htm');
	}
);


$f3->route('GET /free-quote',
	function($f3) {

		
		$f3->set('title',"Get a FREE Pressure Washing Quote - Servicing Honolulu, Hawaii");
		$f3->set('metaDescription','Get a free estimate to power wash your property with Pro Clean Elite!');

		$f3->set('content','free-quote.htm');
		echo View::instance()->render('layouts/layout.htm');
	}
);


$f3->route('POST /contact', 

	function($f3) {

		

		$contactInfo = $f3->get('POST');

		if (!isset($contactInfo['address']))
			$contactInfo['address'] = '';

		if (!isset($contactInfo['services']))
			$contactInfo['services'] = '';

		$message = "
					Name:" .$contactInfo['name']. "
					\nPhone:" .$contactInfo['phone']. "
					\nEmail:" .$contactInfo['email']. "
					\nAddress:" .$contactInfo['address']. "
					\nServices Needed:" .$contactInfo['services'];

		mail("frito833@gmail.com","Contact for Proclean Elite Website",$message);

		$f3->set('messageSent',1);
		$f3->set('content','free-quote.htm');
		echo View::instance()->render('layouts/layout.htm');		
		
	}
);

/*
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

*/

$f3->run();

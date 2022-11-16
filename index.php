<?php
	
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	require('vendor/autoload.php');

	define('INCLUDE_PATH_STATIC','http://localhost/redesocialdevweb20_/DankiCode/Views/pages/');
	define('INCLUDE_PATH','http://localhost/redesocialdevweb20_/');
	$app = new DankiCode\Application();

	$app->run();

?>
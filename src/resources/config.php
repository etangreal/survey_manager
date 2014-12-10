<?php

	$config['db_host'] = '127.0.0.1';
	$config['db_user'] = 'root';
	$config['db_pass'] = 'root';
	$config['db_name'] = 'Survey';

	foreach ($config as $k => $v) {
		define(strtoupper($k), $v);
	}

	// $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>
<?php
	session_start();
	// error_reporting(0);
	
	require 'database/connect.php';
	require 'functions/general.php';
	require 'functions/users.php';

	$user_data = array();

	if ( logged_in() )
		$user_data = user_data($_SESSION['username'], 'username','level');

	$errors = array();
?>
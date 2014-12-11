<?php
	session_start();
	// error_reporting(0);

	require 'database/connect.php';
	require 'functions/general.php';
	require 'functions/users.php';
	require 'functions/admin.php';
	require 'functions/surveys.php';

	$user_data 	= array();
	$errors 	= array();

	if ( logged_in() )
		$user_data = user_data($_SESSION['username'], 'username','level');
?>
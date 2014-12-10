<?php

	function logged_in() {
		return isset($_SESSION['username']);
	}

	function user_exists($username) {
		global $conn;
		$username = sanitize($username);

		$query = "SELECT COUNT(`username`) FROM `SignIn` WHERE `username` = '$username'";
		$query = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($query);

		// print_r($row);
		$count = $row['COUNT(`username`)'];

		return ($count == 1);
	}

	function user_active($username) {
		return true;
	}

	function login($username, $password) {
		global $conn;
		$username 	= sanitize($username);
		$password 	= sanitize($password);
		$password5 	= md5($password);

		$query = "SELECT COUNT(`username`)FROM `SignIn`".
				 " WHERE `username` = '$username'".
				 "   AND (`password` = '$password' OR `password` = '$password5')";

		$query = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($query);

		// print_r($row);
		$count = $row['COUNT(`username`)'];

		return ($count == 1);
	}

?>
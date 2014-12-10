<?php
	if (logged_in()) {
		$username = $_SESSION['username'];
		
		echo 'Hi '.$username."! ( "; 
		?><a href="logout.php">Logout</a> )<?php

	} else {
		header('Location: logout.php');
		exit();
	}
?>
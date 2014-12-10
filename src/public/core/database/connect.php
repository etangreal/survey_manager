<?php 
	$conn_error = "Sorry, we\'re currently experiencing connection problems.";
	$conn = mysqli_connect('127.0.0.1', 'root', 'root', 'Survey') or die(mysql_error($conn_error));
?>
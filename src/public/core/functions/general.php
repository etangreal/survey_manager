<?php

	function sanitize($data) {
		global $conn;
		return mysqli_real_escape_string($conn, $data);
	}

	function output_errors($errors) {
		// print_r($errors);
		return '<ul><li>'. implode('</li><li>', $errors) . '</li></ul>';
	}

?>
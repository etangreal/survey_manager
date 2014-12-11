<?php
	include 'core/init.php';
	// global $errors;

// ------------------------------------------------------------------------------------------------
// PREPERATION
// ------------------------------------------------------------------------------------------------

	if (empty($_POST) === false) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		//echo $username, ' ', $password;

		if (empty($username) || empty($password)) {
			$errors[] = 'Please enter a username and password';

		} else if ( user_exists($username) === false ) {
			$errors[] = 'Invalid username. Have you registered?';

		} else if ( user_active($username) === false ) {
			$errors[] = 'You haven\'t activated your account.';

		} else {

			if ( login($username, $password) === false ) {
				$errors[] = 'Username/Password is incorrect.';

			} else { //login successfull!
				$_SESSION['username'] = $username;

				if (strtoupper($username) == 'ADMIN')
					header('Location: admin.php');
				else
					header('Location: surveys.php');

				exit();
			}

		}//else

	} else {
		$errors[] = 'No login post-data received.';
	}

// ------------------------------------------------------------------------------------------------
// PAGE
// ------------------------------------------------------------------------------------------------

	include 'includes/overall/header.php';
	echo output_errors($errors);
	include 'includes/overall/footer.php';

?>



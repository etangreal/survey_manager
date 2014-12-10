<aside>

	<?php
		if (logged_in()) {
			include 'includes/widgets/loggedIn.php';
		} else {
			include 'includes/widgets/login.php';
		}
	?>

</aside>
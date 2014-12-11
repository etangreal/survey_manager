<?php 
	include 'core/init.php';
	include 'includes/overall/header.php';

	redirect_if_unauthorized_admin();

	$users = get_users();
?>

	<h1> Users </h1>
	<ul><?php
		foreach( $users as $user ) {
			$username = $user['username'];
			echo '<li><a href="surveys.php?username='.$username.'">'.$username.'</a></li>';
		}
	?></ul>

<?php
	include 'includes/overall/footer.php'; 
?>

<?php
	include_once('../resources/db.php');
	$users = get_users();
?>

<html>
	<head>
	</head>
	<body>
		<nav>
			<ul>
				<li><a href='login.php'> Login </a></li>
			</ul>
		</nav>

		<h1> Users </h1>
		<ul><?php
			foreach( $users as $user ) {
				$username = $user['username'];
				echo '<li><a href="surveys.php?username='.$username.'">'.$username.'</a></li>';
			}
		?></ul>
	</body>
</html>
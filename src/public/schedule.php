<?php
	include 'core/init.php';

	$username = $_GET['username'];
	schedule_survey($username);

	header('Location: surveys.php?username='.$username);
	exit();
?>

<html>
	<head>
	</head>
	<body>
		<h1> Scheduling a survey for <?php echo $username ?> ... please wait on moment. </h1>
		<a href="surveys.php?username=<?php echo $username ?>"> back </a>
	</body>
</html>
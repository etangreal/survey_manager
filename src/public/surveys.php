
<?php
	include_once('../resources/db.php');
	$username = $_GET['username'];
	$surveys = get_surveys($username);
?>

<html>
	<head>
	</head>
	<body>
		<nav>
			<ul>
				<li><a href='index.php'> Index </a></li>
			</ul>
		</nav>

		<h1> Surveys for <?php echo $username ?> </h1>
		<ul>
			<li>[ <a href="schedule.php?username=<?php echo $username?>">scedule a new survey</a> ]</il>
			<?php
				if (empty($surveys)) {
					echo '<li> no surveys scheduled </li>';

				} else foreach( $surveys as $survey ) {
					$serveyID = $survey['surveyID'];
					$username = $survey['username'];

					echo '<li><a href="survey.php?'.'surveyID='.$serveyID.'&username='.$username.'">'.
							'SurveyID: '.$serveyID.
						 	//' (Username: '.$username.') '.
						 '</a></li>';
				}
		?></ul>
	</body>
</html>
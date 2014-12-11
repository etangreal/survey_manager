<?php
	include 'core/init.php';

	redirect_if_unauthorized_user();
	redirect_if_unmatched_user();

	$username = (isset($_GET['username'])) ? $_GET['username'] : $user_data['username'];
	$surveys  = get_surveys($username);

	include 'includes/overall/header.php';
?>

	<h1> Surveys for <?php echo $username ?> </h1>
	<ul>
		<?php
			if (is_admin()) 
				echo '<li>[ <a href="schedule.php?username='.$username.'">scedule a new survey</a> ]</il>';

			if (empty($surveys)) {
				echo '<li> no surveys scheduled </li>';

			} else foreach( $surveys as $survey ) {
				$serveyID = $survey['surveyID'];
				echo '<li><a href="survey.php?surveyID='.$serveyID.'&username='.$username.'">SurveyID: '.$serveyID.'</a></li>';
			}
		?>
	</ul>

<?php
	include 'includes/overall/footer.php'; 
?>
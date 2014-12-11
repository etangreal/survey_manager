<?php
	include 'core/init.php';

	redirect_if_unauthorized_user();

	if ( isset($_POST['surveyID']) ) {
		echo 'Form was submitted.... <br />';

		$surveyID	= $_POST['surveyID'];
		$questions 	= json_decode($_POST['questions']);
		$answers 	= json_decode($_POST['answers']);

		save_survey($surveyID,$questions,$answers);
	}

	$username = (isset($_POST['username'])) ? $_POST['username'] : $user_data['username'];
	header('Location: surveys.php?username='.$username);
	exit();

?>
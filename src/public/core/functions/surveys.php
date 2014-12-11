<?php

	// --------------------------------------------------------------------------------------------

	function get_surveys($username) {
		global $conn;

		$username 	= sanitize($username);
		$surveys 	= array();

		$query = "SELECT *
					FROM `Survey`
				   WHERE `username` = '$username' AND finished IS NULL".
			  " ORDER BY `created`";

		$query = mysqli_query($conn,$query);

		while ( $row = mysqli_fetch_assoc($query) )
			$surveys[] = $row;

		return $surveys;
	}

	// --------------------------------------------------------------------------------------------

	function get_survey($surveyID) {
		global $conn;

		$surveyID = sanitize($surveyID);

		$query 	= "SELECT * FROM `Survey` WHERE surveyID = '$surveyID' AND finished IS NULL";
		$query 	= mysqli_query($conn,$query);
		$survey = mysqli_fetch_assoc($query);

		return $survey;
	}

	// --------------------------------------------------------------------------------------------

	function get_questions() {
		global $conn;

		$questions = array();

		$query 	= "SELECT * FROM `Questions` ORDER BY `created`";
		$query 	= mysqli_query($conn,$query);

		while ($row = mysqli_fetch_assoc($query))
			$questions[] = $row;

		return $questions;
	}

	// --------------------------------------------------------------------------------------------

	function get_answers() {
		global $conn;

		$answers = array();

		$query = "SELECT * FROM `Answers` ORDER BY `value`";
		$query = mysqli_query($conn,$query);

		while ($row = mysqli_fetch_assoc($query))
			$answers[] = $row;

		return $answers;
	}

	// --------------------------------------------------------------------------------------------

	function save_survey($surveyID, $questions, $answers) {
		global $conn;

		$surveyID = sanitize($surveyID);
		// ToDo: adapt sanitize to manage arrays...
		// $questions = sanitize($questions);
		// $answers = sanitize($answers);

		for ($i = 0; $i < sizeOf($questions); $i++) {
			$questionID = $questions[$i];
			$value 		= $answers[$i];

			$query = "INSERT INTO `SurveyAnswers` SET 
					   surveyID 	= '".$surveyID."'".
					", questionID 	= '".$questionID."'".
					", value 		= ".$value;


			if (mysqli_query($conn, $query)) {
				echo "Survey Saved successfully <br/>";
				mark_survey_finished($surveyID);
			} else {
				echo "Error saving Survey: " . $query . "<br/>" . mysqli_error($conn) . "<br/>";
			}

		}//for
	}

	// --------------------------------------------------------------------------------------------

	function mark_survey_finished($surveyID) {
		global $conn;

		$surveyID = sanitize($surveyID);

		$query = "UPDATE `Survey` SET
				 		 `finished` = '".date('Y-m-d H:i:s')."'".
				 " WHERE `surveyID` = '".$surveyID."'";

		if (mysqli_query($conn, $query)) {
			echo "Survey updated. <br/>";
		} else {
			echo "Error: " . $query . "<br/>" . mysqli_error($conn) . "<br/>";
		}
	}

	// --------------------------------------------------------------------------------------------

	function schedule_survey($username) {
		global $conn;
		//ToDo: Check $username exists and is valid ...

		$query = "INSERT INTO `Survey` SET 
					   surveyID = '".uniqid()."'".
					", username = '".$username."'";

		$query = mysqli_query($conn,$query);
	}

	// --------------------------------------------------------------------------------------------

?>
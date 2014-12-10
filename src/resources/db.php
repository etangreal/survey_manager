
<?php
	include_once('config.php');

	// --------------------------------------------------------------------------------------------
	// GENERAL-DATABASE
	// --------------------------------------------------------------------------------------------

	function con() {
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if (!$con) {
			echo "Unable to connect to DB: " . mysqli_error();
			exit;
		}

		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		return $con;
	}

	// --------------------------------------------------------------------------------------------

	function sanitize($data) {
		return mysql_real_escape_string($data);
	}

	// --------------------------------------------------------------------------------------------
	// USER
	// --------------------------------------------------------------------------------------------

	function get_users() {
		$query = "SELECT * FROM `SignIn`";
		$query = mysqli_query(con(),$query);

		if (!$query) {
			echo "get_user | Could not successfully run query." . mysqli_error();
			exit;
		}

		if (mysqli_num_rows($query) == 0) {
			echo "get_user | No rows found, nothing to print so am exiting";
			exit;
		}

		$users = array();
		while ($row = mysqli_fetch_assoc($query)) {
			$users[] = $row;
		}

		mysqli_free_result($query);

		return $users;
	}

	// --------------------------------------------------------------------------------------------

	function authenticate($username, $password) {
		$username = sanitize($username);
		$password = sanitize($password);

		$con 	= con();
		$query 	= "SELECT COUNT(`user_id`) FROM `SignIn` ".
				  " WHERE `username` = '$username'".
				  "   AND `password` = '$password'";

		$query = mysqli_query($con, $query);

		if ($query) {
			echo 'user_exists executed successfully.';
		} else {
			echo "Error quering user_exists: " . $query . "<br/>" . mysqli_error($con) . "<br/>";
		}

		$auth = (mysqli_result($query, 0) == 1) ? true : false;

		mysqli_free_result($query);
		return $auth;
	}


	// --------------------------------------------------------------------------------------------

	function user_exists($username) {
		$username = sanitize($username);

		$con = con();
		$query = "SELECT COUNT(`user_id`) FROM `SignIn` ".
				 " WHERE `username` = '".$username."'";

		$query = mysqli_query($con, $query);

		if ($query) {
			echo 'user_exists executed successfully.';
		} else {
			echo "Error quering user_exists: " . $query . "<br/>" . mysqli_error($con) . "<br/>";
		}

		$exists = (mysqli_result($query, 0) == 1) ? true : false;

		mysqli_free_result($query);
		return $exists;
	}

	// --------------------------------------------------------------------------------------------

	function user_level($username) {
		$username = sanitize($username);

		$con 	= con();
		$query 	= "SELECT `level` FROM `SignIn` ".
				  " WHERE `username` = '$username'";

		$query = mysqli_query($con, $query);

		if ($query) {
			echo 'user_level executed successfully.';
		} else {
			echo "Error querying user_exists: " . $query . "<br/>" . mysqli_error($con) . "<br/>";
		}

		$level = $query['level'];

		mysqli_free_result($query);
		return $level;
	}

	// --------------------------------------------------------------------------------------------
	// GET QUESTIONS & ANSWERS
	// --------------------------------------------------------------------------------------------

	function get_questions() {
		$query 	= "SELECT * FROM `Questions` ORDER BY `created`";
		$query = mysqli_query(con(),$query);

		// echo $query;

		if (!$query) {
			echo "get_questions | Could not successfully get the questions." . mysqli_error();
			exit;
		}

		$questions = array();
		while ($row = mysqli_fetch_assoc($query)) {
			$questions[] = $row;
		}

		mysqli_free_result($query);

		return $questions;
	}

	function get_answers() {
		$query = "SELECT * FROM `Answers` ORDER BY `value`";
		$query = mysqli_query(con(),$query);

		if (!$query) {
			echo "get_answers | Could not successfully get the answers." . mysqli_error();
			exit;
		}

		$answers = array();
		while ($row = mysqli_fetch_assoc($query)) {
			$answers[] = $row;
		}

		mysqli_free_result($query);

		return $answers;
	}

	// --------------------------------------------------------------------------------------------
	// SURVEY
	// --------------------------------------------------------------------------------------------

	function get_surveys($username) {
		$query = "SELECT *
					FROM `Survey`
				   WHERE `username` = '".$username."' AND finished IS NULL".
			  " ORDER BY `created`";

		// echo $query;

		$query = mysqli_query(con(),$query);

		$surveys = array();

		if ($query) {
			while ($row = mysqli_fetch_assoc($query)) {
				$surveys[] = $row;
			}

			mysqli_free_result($query);
		}

		// if (mysqli_num_rows($query) == 0) {
		// 	echo "get_surveys | No rows found, nothing to print so am exiting";
		// 	exit;
		// }

		return $surveys;
	}

	// --------------------------------------------------------------------------------------------

	function schedule_survey($username) {
		//ToDo: Check $username exists and is valid ...

		$query = "INSERT INTO `Survey` SET 
					   surveyID = '".uniqid()."'".
					", username = '".$username."'";

		//echo $username;
		//echo $query;

		$query = mysqli_query(con(),$query);
		mysqli_free_result($query);
	}

	// --------------------------------------------------------------------------------------------

	function get_survey($surveyID) {
		$query = "SELECT * FROM `Survey` WHERE surveyID = '".$surveyID."'";
		$query = mysqli_query(con(),$query);

		if (!$query) {
			echo "get_survey | Could not successfully get the questions." . mysqli_error();
			exit;
		}

		$survey = mysqli_fetch_assoc($query);
		mysqli_free_result($query);

		return $survey;
	}

	// --------------------------------------------------------------------------------------------

	function mark_survey_finished($surveyID) {
		$query = "UPDATE `Survey` SET
				 		 `finished` = '".date('Y-m-d H:i:s')."'".
				 " WHERE `surveyID` = '".$surveyID."'";

		// echo $query;

		$con = con();
		if (mysqli_query($con, $query)) {
			echo "Survey updated. <br/>";
		} else {
			echo "Error: " . $query . "<br/>" . mysqli_error($con) . "<br/>";
		}
	}

	// --------------------------------------------------------------------------------------------

	function save_survey($surveyID, $username, $questions, $answers) {
		$con = con();

		for ($i = 0; $i < sizeOf($questions); $i++) {
			$questionID = $questions[$i];
			$value 		= $answers[$i];

			$query = "INSERT INTO `SurveyAnswers` SET 
					   surveyID 	= '".$surveyID."'".
					", questionID 	= '".$questionID."'".
					", value 		= ".$value;

			// echo $query.'<br />';

			if (mysqli_query($con, $query)) {
				echo "Survey Saved successfully <br/>";
				mark_survey_finished($surveyID);
			} else {
				echo "Error saving Survey: " . $query . "<br/>" . mysqli_error($con) . "<br/>";
			}

		}//for

	}//save_survey

	// --------------------------------------------------------------------------------------------
	// END
	// --------------------------------------------------------------------------------------------

?>
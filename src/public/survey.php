
<?php
	include_once('../resources/db.php');

	$surveyID = $_GET['surveyID'];
	$username = $_GET['username'];

	if ( isset($_POST['posted']) ) {
		echo 'Form was submitted.... <br />';

		$questions = json_decode($_POST['questions']);
		$answers = json_decode($_POST['answers']);

		save_survey($surveyID,$username,$questions,$answers);

		header('Location: surveyS.php?username='.$username);
		die();
	}

	$survey 	= get_survey($surveyID);
	$surveyID 	= $survey['surveyID'];

	$questions 	= get_questions();
	$length		= sizeOf($questions);
	$answers 	= get_answers();
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/survey.php.css">
		<script>
			survey = {

				length: <?php echo $length ?>,
				current: 0,

				questions: [ 
					<?php foreach( $questions as $question ) { 
						echo "'".$question['questionID']."',";
					}?>
				],

				answers: [
					<?php foreach( $questions as $question ) { 
						echo '0'.",";
					}?>
				],

				q: function() { return $('#q'+survey.current) },

				show: function () { 
					survey.q().css("display","block") 
				},

				hide: function () { 
					survey.q().css("display","none") 
				},

				next: function() {
					if (survey.current == survey.length-1) return;

					survey.hide();
					survey.current++;
					survey.show();
				},

				previous: function() { 
					if (survey.current == 0) return;

					survey.hide();
					survey.current--; 
					survey.show();
				},

				validate: function() {
					var isValid = true;

					for(var i=0; i < survey.length; i++) {
						var r = $('[name="r'+i+'"]:checked');
						if (r && r.val())
							survey.answers[i] = parseInt(r.val(), 0);

						isValid = isValid && (survey.answers[i] > 0);
					}

					return isValid;
				}
			}
		</script>
	</head>
	<body>
		<nav>
			<ul>
				<li><a href='index.php'> Index </a></li>
			</ul>
		</nav>

		<h1> Survey for <?php echo $username ?> </h1>

		<div>
			<?php
				$i = 0;
				foreach( $questions as $question ) {
					$id 	= $question['questionID'];
					$text 	= $question['questionsText_EN'];

					?><div id="q<?php echo $i?>" class="question">
						<label> (<?php echo $i+1 ?>/<?php echo $length ?>)</label>:
						<?php echo $text ?> 
						<br/>
						<?php
							foreach( $answers as $answer ) {
								$value 	= $answer['value'];
								$text 	= $answer['text'];

								echo '&nbsp;&nbsp;<input type="radio" name="r'.$i.'" value='.$value.'>&nbsp; '.$text.'&nbsp;&nbsp;';
							}
						?>
					</div>
					<?php
					$i++;
				}
			?>

			<br />
			<div id="controls">
				<input type='button' value='previous' id='previous'>
				<input type='button' value='next' id='next'>
			</div>

			<br />
			<div>
				<input type='button' value='submit' id="submit">
			</div>
		<div>

		<form action='' method='post' id='survey'>
			<input type="hidden" name="posted" value="true">
			<input type="hidden" name="answers" id="answers" value="true">
			<input type="hidden" name="questions" id="questions" value="true">
		</form>
	</body>

	<!-- 3rd Party Libraries  -->
	<script src="libs/jquery-2.1.1.min.js"></script>

	<!-- Scripts -->
	<script src="js/survey.php.js"></script>

</html>

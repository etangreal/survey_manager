<?php
	include 'core/init.php';

	redirect_if_unauthorized_user();
	redirect_if_unmatched_user();

	$username = (isset($_GET['username'])) ? $_GET['username'] : $user_data['username'];

	$surveyID 	= $_GET['surveyID'];
	$survey 	= get_survey($surveyID);

	if ($survey['username'] != $username)
		redirect_if_unauthorized_admin();

	$questions 	= get_questions();
	$answers 	= get_answers();
	$length		= sizeOf($questions);

	include 'includes/overall/header.php';
?>
	<h1> Survey for <?php echo $username ?> </h1>
	<br />

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
	<div>

	<br />
	<div id="controls">
		<input type='button' value='previous' id='previous'>
		<input type='button' value='next' id='next'>
	</div>
	<br />

	<br />
	<br />
	<br />
	<div>
		<input type='button' value='submit survey' id="submit">
	</div>

	<form action='submit_survey.php' method='post' id='survey'>
		<input type="hidden" name="surveyID" 	id="surveyID" value="<?php echo $surveyID ?>">
		<input type="hidden" name="username" 	id="username" value="<?php echo $username ?>">
		<input type="hidden" name="answers" 	id="answers">
		<input type="hidden" name="questions" 	id="questions">
	</form>

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

	<!-- 3rd Party Libraries  -->
	<script src="libs/jquery-2.1.1.min.js"></script>

	<!-- Scripts -->
	<script src="js/survey.php.js"></script>

<?php
	// include 'includes/overall/footer.php'; 
?>
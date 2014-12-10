
// ------------------------------------------------------------------------------------------------
// EVENTS
// ------------------------------------------------------------------------------------------------

var onNext = function() {
	survey.next();
}

var onPrevious = function() {
	survey.previous();
}

var onSubmit = function(e) {
	e.preventDefault();

	if (!survey.validate()) {
		alert('You must complete every question of the survey.');
		return;
	}

	$('#answers').val( JSON.stringify(survey.answers) );
	$('#questions').val( JSON.stringify(survey.questions) );

	document.forms["survey"].submit();
}

var onLoad = function() {
	survey.show();

	$('#next').on('click', onNext);
	$('#previous').on('click', onPrevious);
	$('#submit').on('click', onSubmit);
}

// ------------------------------------------------------------------------------------------------
// INIT
// ------------------------------------------------------------------------------------------------

window.onload = onLoad;

// ------------------------------------------------------------------------------------------------
// END
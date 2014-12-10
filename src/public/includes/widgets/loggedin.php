<?php

	function plus($url,$title) {
		return "<li><a href='$url'>$title</a></li>";
	}

	if (!logged_in()) {
		header('Location: logout.php');
		exit();
	}

	$welcome = "Hi ".$user_data['username']."!";

	$links	 = "<ul>";
	
	if ($user_data['level'] == 1) //i.e. if the user is admin
		$links 	.= plus('index.php','Admin');

	$links 	.= plus('logout.php','Logout');
	$links	.= "</ul>";

?>

<div class="widget">
	<h2><?php echo $welcome ?></h2>
	<div class="inner">
		<?php echo $links ?>
	</div>
</div>
<?php

	// --------------------------------------------------------------------------------------------

	function is_admin() {
		global $user_data;
		return ( isset($user_data['level']) && ($user_data['level'] == 1) );
	}

	// --------------------------------------------------------------------------------------------

	function redirect_if_unauthorized_admin() {
		if ( logged_in() && is_admin() ) return;

		redirect_to_index();
	}

	// --------------------------------------------------------------------------------------------

	function redirect_if_unmatched_user() {
		if ( isset($_SESSION['username']) == false )
			redirect_to_index();

		$username = $_SESSION['username'];

		if ( isset($_GET['username']) )
			if ($_GET['username'] != $username)
				redirect_if_unauthorized_admin();
	}

	// --------------------------------------------------------------------------------------------

?>
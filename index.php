<?php
	// Include the header
	include 'inc/layouts/header.php';

	if ( isset( $_SESSION['login'] ) && $_SESSION['login'] == true ) {
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'logout' ) {
			// If the user request logout include logout page
			include 'inc/views/logout.php';
		} else {
			// If the user logged in include profile page
			include 'inc/views/profile.php';
		}
	} else {
		// If the user not logged in ( 
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'signup' ) {
			// If the user request a signup page
			include 'inc/views/signup.php';
		} else {
			// if the user request login page
			include 'inc/views/login.php';
		}
	}

	// Include the footer
	include 'inc/layouts/footer.php';

?>
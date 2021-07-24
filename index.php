<?php
	// Include the header
	include 'inc/layouts/header.php';
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'signup' ) {
		include 'inc/views/signup.php';
	} else {
		include 'inc/views/login.php';
	}
	// Include the footer
	include 'inc/layouts/footer.php';

?>
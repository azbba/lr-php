<?php

/**
 * Helper functions 
*/

/**
 * form_errors()
 * Function to form display errors
 * @param array $errors
*/
function form_errors( array $errors ) {
	if ( !empty( $errors ) ) {
		echo '<div class="errors-container mt-3">';
		foreach ( $errors as $error ) {
			?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo $error; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
		}
		echo '</div>';
	}
}

/**
 * login_saved_input()
 * Function to reprint login input value after submit the form 
*/

function login_saved_input() {
	$login_value = '';
	if ( isset($_POST['login']) ) {
		$login_value = $_POST['login'];
	} elseif ( isset($_SESSION['email']) ) {
		$login_value = $_SESSION['email'];
	}
	echo $login_value; 
}
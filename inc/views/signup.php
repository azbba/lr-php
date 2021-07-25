<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		// Sanitize user inputs
		$username 	= filter_var( $_POST['username'], FILTER_SANITIZE_STRING );
		$email 		= filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
		$password 	= filter_var( $_POST['password'], FILTER_SANITIZE_STRING );
		$repassword = filter_var( $_POST['repassword'], FILTER_SANITIZE_STRING );

		// Start our validation
		$username_errors		= $validate->validate_username( $username );
		$email_errors 			= $validate->validate_email( $email );
		$password_errors 		= $validate->validate_password( $password );
		$repassword_errors 	= $validate->validate_repassword( $password, $repassword );

		// Check if there's no errors
		if ( $validate->error_count == 0 ) {
			$hash_password = password_hash( $password, PASSWORD_DEFAULT );
			$register = $db->signup( $username, $email, $hash_password );
			if ( $register ) {
				// Redirect to login page
				$_SESSION['email'] = $email;
				header( 'Location: /' );
			}
		}

	}
?>
<h1 class="page-title text-center fw-bolder">Signup</h1>
<div class="d-flex justify-content-center">
	<form class="form signup-form w-50" action="<?php echo $_SERVER['PHP_SELF'] . '?page=signup'; ?>" method="post" autocomplete="off">
		<div class="mb-3">
			<label for="userInput" class="form-label fw-bold">Username</label>
			<input id="userInput" class="form-control" type="text" name="username" placeholder="john doe" value="<?php echo ( isset( $_POST['username'] ) ? $_POST['username'] : '' ); ?>">
			<?php form_errors( ( isset( $username_errors ) ? $username_errors : [] ) ); ?>
		</div>
		<div class="mb-3">
			<label for="emailInput" class="form-label fw-bold">Email</label>
			<input id="emailInput" class="form-control" type="email" name="email" placeholder="email@email.com" aria-describedby="emailHelp" value="<?php echo ( isset( $_POST['email'] ) ? $_POST['email'] : '' ); ?>">
			<?php form_errors( ( isset( $email_errors ) ? $email_errors : [] ) ); ?>
		</div>
		<div class="mb-3">
			<label for="passwordInput" class="form-label fw-bold">Password</label>
			<input id="passwordInput" class="form-control" type="password" name="password" placeholder="Your password">
			<?php form_errors( ( isset( $password_errors ) ? $password_errors : [] ) ); ?>
		</div>
		<div class="mb-3">
			<label for="repasswordInput" class="form-label fw-bold">Confirm Password</label>
			<input id="repasswordInput" class="form-control" type="password" name="repassword" placeholder="Confirm your password">
			<?php form_errors( ( isset( $repassword_errors ) ? $repassword_errors : [] ) ); ?>
		</div>
		<input type="submit" class="btn btn-danger" value="Signup">
	</form>
</div> <!-- .d-flex -->
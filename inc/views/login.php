<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		$login 		= filter_var( $_POST['login'], FILTER_SANITIZE_STRING );
		$password 	= filter_var( $_POST['password'], FILTER_SANITIZE_STRING );

		// Start our validation
		$login_errors	 	= $validate->validate_username( $login, false );
		$password_errors 	= $validate->validate_password( $password, false );

		// Check there's no errors
		if ( $validate->error_count == 0  ) {
			$logged = $db->login( $login, $password );
			// Check if the username and the password are correct
			if ( !empty( $logged ) && $logged !== false ) {
				
				// Start the seassion
				$_SESSION['login'] 		= true;
				$_SESSION['username'] 	= $logged['username'];
				$_SESSION['user_id'] 	= $logged['id'];
				$_SESSION['role'] 		= $logged['role'] == 0 ? 'user' : 'admin';
				// Redirect to profile page
				header( 'Location: /' );
				exit();

			} else {
				$login_errors[] = 'the <strong>Username</strong> or <strong>Password</strong> Is Incorrect';
			}
		}
	}
?>

<h1 class="page-title text-center fw-bolder">Login</h1>
<div class="d-flex justify-content-center">
	<form class="form login-form w-50" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<?php
			if ( isset( $_SESSION['create_account'] ) && ! empty( $_SESSION['create_account'] ) ) {
				success_msg( $_SESSION['create_account'] );
				// Display this message only once 
				unset( $_SESSION['create_account'] );
			}
		?>
		<div class="mb-3">
			<label for="loginInput" class="form-label fw-bold">Email or Username</label>
			<input id="loginInput" class="form-control" type="text" name="login" placeholder="john doe or email@email.com" value="<?php login_saved_input(); ?>">
			<?php form_errors( ( isset( $login_errors ) ? $login_errors : [] ) ); ?>
		</div>
		<div class="mb-3">
			<label for="passwordInput" class="form-label fw-bold">Password</label>
			<input id="passwordInput" class="form-control" type="password" name="password" placeholder="Your password">
			<?php form_errors( isset( $password_errors ) ? $password_errors : [] ); ?>
		</div>
		<input type="submit" class="btn btn-primary" value="login">
	</form>
</div> <!-- .d-flex -->
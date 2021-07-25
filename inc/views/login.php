<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		$login 		= filter_var( $_POST['login'], FILTER_SANITIZE_STRING );
		$password 	= filter_var( $_POST['password'], FILTER_SANITIZE_STRING );

		// Start our validation
		$login_errors = [];
		$password_errors = [];

		// Check if login or password fields are empty
		if ( empty( $login ) ) {
			$login_errors[] = 'The <strong>username or email</strong> fields are required to loggin';
		}

		if ( empty( $password ) ) {
			$password_errors[] = 'The <strong>Password</strong> field is required to loggin';
		}

		// Check there's no errors
		if ( empty( $login_errors ) && empty( $password_errors ) ) {
			$logged = $db->login( $login, $password );
			// Check if the username and the password are correct
			if ( !empty( $logged ) && $logged !== false ) {
				
				// Start the seassion
				$_SESSION['login'] = true;
				$_SESSION['username'] = $logged['username'];
				$_SESSION['user_id'] = $logged['id'];
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
		<div class="mb-3">
			<label for="loginInput" class="form-label fw-bold">Email or Username</label>
			<input id="loginInput" class="form-control" type="text" name="login" placeholder="john doe or email@email.com" autofocus>
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
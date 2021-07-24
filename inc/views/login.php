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
			<?php
				if ( !empty( $login_errors ) ) {
					echo '<div class="errors-container mt-3">';
					foreach ( $login_errors as $error ) {
						?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<?php echo $error; ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php
					}
					echo '</div>';
				}
			?>
		</div>
		<div class="mb-3">
			<label for="passwordInput" class="form-label fw-bold">Password</label>
			<input id="passwordInput" class="form-control" type="password" name="password" placeholder="Your password">
			<?php
				if ( !empty( $password_errors ) ) {
					echo '<div class="errors-container mt-3">';
					foreach ( $password_errors as $error ) {
						?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<?php echo $error; ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php
					}
					echo '</div>';
				}
			?>
		</div>
		<input type="submit" class="btn btn-primary" value="login">
	</form>
</div> <!-- .d-flex -->
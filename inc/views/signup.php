<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		// Sanitize user inputs
		$username 	= filter_var( $_POST['username'], FILTER_SANITIZE_STRING );
		$email 		= filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
		$password 	= filter_var( $_POST['password'], FILTER_SANITIZE_STRING );
		$repassword = filter_var( $_POST['repassword'], FILTER_SANITIZE_STRING );
		// Start our validation
		$username_errors		= [];
		$email_errors 			= [];
		$password_errors 		= [];
		$repassword_errors 	= [];

		// Validate username input
		if ( empty( $username ) ) {
			$username_errors[] = 'The <strong>Username</strong> field is required';
		}
		if ( strlen( $username ) < 5 || strlen( $username ) > 50 ) {
			$username_errors[] = 'The <strong>Username</strong> field must be between 5 and 50 characters.';
		}
		if ( $db->unique_record( 'users', 'username', $username ) ) {
			$username_errors[] = 'This <strong>Username</strong> already exists.';
		}

		// Validate email input
		if ( empty( $email ) ) {
			$email_errors[] = 'The <strong>Email</strong> field is required';
		}
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) === false ) {
			$email_errors[] = 'The <strong>Email</strong> field must be a valid email address.';
		}
		if ( $db->unique_record( 'users', 'email', $email ) ) {
			$email_errors[] = 'This <strong>Email</strong> already exists.';
		}

		// Validate password input
		if ( empty( $password ) ) {
			$password_errors[] = 'The <strong>Password</strong> field is required';
		}
		if ( strlen( $password ) < 8 || strlen( $password ) > 255 ) {
			$password_errors[] = 'The <strong>Password</strong> field must be between 8 and 255 characters.';
		}

		// Validate repassword
		if ( $password !== $repassword ) {
			$repassword_errors[] = 'The <strong>Passwords</strong> do not match';
		}

		// Check if there's no errors
		if ( empty($username_errors) && empty($email_errors) && empty($password_errors) && empty($repassword_errors) ) {
			
		}

	}
?>
<h1 class="page-title text-center fw-bolder">Signup</h1>
<div class="d-flex justify-content-center">
	<form class="form login-form w-50" action="<?php echo $_SERVER['PHP_SELF'] . '?page=signup'; ?>" method="post" autocomplete="off">
		<div class="mb-3">
			<label for="userInput" class="form-label fw-bold">Username</label>
			<input id="userInput" class="form-control" type="text" name="username" placeholder="john doe" autofocus>
			<?php
				if ( !empty( $username_errors ) ) {
					echo '<div class="errors-container mt-3">';
					foreach ( $username_errors as $error ) {
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
			<label for="emailInput" class="form-label fw-bold">Email</label>
			<input id="emailInput" class="form-control" type="email" name="email" placeholder="email@email.com" aria-describedby="emailHelp">
			<?php
				if ( !empty( $email_errors ) ) {
					echo '<div class="errors-container mt-3">';
					foreach ( $email_errors as $error ) {
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
		<div class="mb-3">
			<label for="repasswordInput" class="form-label fw-bold">Confirm Password</label>
			<input id="repasswordInput" class="form-control" type="password" name="repassword" placeholder="Confirm your password">
			<?php
				if ( !empty( $repassword_errors ) ) {
					echo '<div class="errors-container mt-3">';
					foreach ( $repassword_errors as $error ) {
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
		<input type="submit" class="btn btn-danger" value="Signup">
	</form>
</div> <!-- .d-flex -->
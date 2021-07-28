<?php
	// Get user data
	$user_data = $db->get_record( 'users', 'id', $_SESSION['user_id'] );

	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if ( isset( $_POST['login_form'] ) && isset( $_POST['lform'] ) ) {
			// Sanitize login form info
			$username 		= filter_var( $_POST['username'], FILTER_SANITIZE_STRING );
			$email 			= filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
			$oldpassword 	= filter_var( $_POST['oldpassword'], FILTER_SANITIZE_STRING );
			$newpassword 	= filter_var( $_POST['newpassword'], FILTER_SANITIZE_STRING );
			// Start our Validation
			$username_errors		= $validate->validate_username( $username, false, true, $_SESSION['user_id'] );
			$email_errors			= $validate->validate_email( $email, true, $_SESSION['user_id'] );
			// validate password only if user tape a new password
			if ( !empty( $newpassword ) ) {
				$oldpassword_errors	= $validate->validate_oldpassword( $oldpassword, $user_data['password'] );
				$newpassword_errors	= $validate->validate_password( $newpassword );
				// Reset password value
				$user_data['password'] = password_hash( $newpassword, PASSWORD_DEFAULT );
			}
			// If there's no errors
			if ( $validate->error_count == 0 ) {
				// Update columns
				$columns = [
					'username'		=> $username,
					'email'			=> $email,
					'password'		=> $user_data['password']
				];
				$update = $db->update( 'users', $columns, $_SESSION['user_id'] );
				if ( $update ) {
					$seconds = 3;
					$success_msg_login = 'The <strong>Login information</strong> has been updated successfully, Refresh in <span id="refershCounter" class="fw-bold" data-seconds="' . $seconds . '">'. $seconds .'</span> seconds';
					// Refresh the page
					header( "Refresh:$seconds" );
				}
			}
		}
	}
?>

<form class="form login-form" action="<?php echo $_SERVER['PHP_SELF'] . '?page=profile&form=login'; ?>" method="post" autocomplete="off">
	<h3 class="form-title">Login information</h3>
	<?php success_msg( ( isset( $success_msg_login ) ? $success_msg_login : '' ) ); ?>
	<input type="hidden" name="login_form" value="1">
	<div class="mb-3">
		<label for="userInput" class="form-label fw-bold">Username</label>
		<input id="userInput" class="form-control" type="text" name="username" placeholder="john doe" value="<?php echo $user_data['username']; ?>">
		<?php form_errors( ( isset( $username_errors ) ? $username_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="emailInput" class="form-label fw-bold">Email</label>
		<input id="emailInput" class="form-control" type="email" name="email" placeholder="email@email.com"  value="<?php echo $user_data['email']; ?>"aria-describedby="emailHelp">
		<?php form_errors( ( isset( $email_errors ) ? $email_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<p class="text-muted">Leave it empty if don't want to change your password</p>
		<label for="oldPasswordInput" class="form-label fw-bold">Old Password</label>
		<input id="oldPasswordInput" class="form-control" type="password" name="oldpassword" placeholder="Tape your old password">
		<?php form_errors( ( isset( $oldpassword_errors ) ? $oldpassword_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="newPasswordInput" class="form-label fw-bold">New Password</label>
		<input id="newPasswordInput" class="form-control" type="password" name="newpassword" placeholder="Tape a new password">
		<?php form_errors( ( isset( $newpassword_errors ) ? $newpassword_errors : [] ) ); ?>
	</div>
	<input type="submit" class="btn btn-success" name="lform" value="Update">
</form>
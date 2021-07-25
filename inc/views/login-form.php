<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if ( isset( $_POST['login_form'] ) && isset( $_POST['lform'] ) ) {
			// login form validation
		}
	}
?>

<form class="form login-form" action="<?php echo $_SERVER['PHP_SELF'] . '?page=profile&form=login'; ?>" method="post" autocomplete="off">
	<p class="text-muted">Login information</p>
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
		<?php form_errors( ( isset( $old_password_errors ) ? $old_password_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="newPasswordInput" class="form-label fw-bold">New Password</label>
		<input id="newPasswordInput" class="form-control" type="password" name="newpassword" placeholder="Tape a new password">
		<?php form_errors( ( isset( $new_password_errors ) ? $new_password_errors : [] ) ); ?>
	</div>
	<input type="submit" class="btn btn-danger" name="lform" value="Update">
</form>
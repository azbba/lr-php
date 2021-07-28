<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if ( isset( $_POST['delete-account'] ) && isset( $_POST['deleteform'] ) ) {
			// Sanitize inputs
			$confirm_password 	= filter_var( $_POST['confirm_password'], FILTER_SANITIZE_STRING );
			// Start our Validation
			$confirm_pass_errors	= $validate->validate_oldpassword( $confirm_password, $user_data['password'], 'Password' );
			// Check if there's no errors
			if ( $validate->error_count == 0 ) {
				$delete_account = $db->delete( 'users', $_SESSION['user_id'] );
				if ( $delete_account ) {
					// Destroy the session
					session_unset();
					$_SESSION['delete_account'] = 'Your account has been deleted successfully, Feel free to create new account in our website';
					header( 'Location: /?page=signup' );
				}
			}
		}
	}
?>

<hr />

<form class="form delete-form" action="<?php echo $_SERVER['PHP_SELF'] . '?page=profile&form=delete'; ?>" method="post">
	<h3 class="form-title">Delete your account</h3>
	<p class="text-danger">By deleting your account, Your profile, photos, and everything else you've added will be permanently deleted.</p>
	<input type="hidden" name="delete-account" value="1">
	<div class="mb-3">
		<label for="passwordInput" class="form-label fw-bold">Password</label>
		<p class="text-muted small">Enter your password to remove your account</p>
		<input id="passwordInput" class="form-control" type="password" name="confirm_password" placeholder="Your password">
		<?php form_errors( isset( $confirm_pass_errors ) ? $confirm_pass_errors : [] ); ?>
	</div>
	<input type="submit" class="btn btn-danger" name="deleteform" value="Delete" onclick="confirm('Are You sure?, This process cannot be undone')">
</form>
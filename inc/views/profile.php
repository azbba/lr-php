<?php
	// Get logged user data from users and profiles table
	$user_data = $db->join( 'users', 'profiles', 'id', 'user_id', $_SESSION['user_id'] );
?>
<h1 class="page-title fw-bolder text-capitalize mb-5"><?php echo $_SESSION['username']; ?> Profile</h1>
<div class="row">
	<div class="col-md-3">
		<?php include 'login-form.php'; ?>
	</div>  <!-- .col -->
	<div class="col-md-9">
		<?php include 'profile-form.php'; ?>
	</div>
</div> <!-- .row -->
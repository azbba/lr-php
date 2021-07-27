<?php
	// Get logged user data from users and profiles table
	// You cant fetch the data by using join() or get_record() methods.
	// If use get_record() two request sended to database one to users table, second one to profiles table.
	// Refersh the page, after each time you submit forms,
	// if you use join() method to fetch data.
	// $user_data = $db->join( 'users', 'profiles', 'id', 'user_id', $_SESSION['user_id'] );
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
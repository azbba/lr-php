<?php
	// Protect access to this page from users (Only admins can access to this page)
	if ( isset( $_SESSION['role'] ) && $_SESSION['role'] == 'user' ) {
		// Redirect users to profile page
		header( 'Location: /?page=profile' );
	}
?>
<h1>Dashboard</h1>

<div class="statistics">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<!-- Count users -->
			<div class="stat all-stat d-flex bg-primary text-light mb-3">
				<div class="icon d-flex justify-content-center align-items-center px-3">
					<i class="las la-users"></i>
				</div>
				<div class="data flex-grow-1 p-4">
					<h4>All users</h4>
					<span><?php echo $db->count( 'users', 'id' ) ?></span>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<!-- Numbers of admins -->
			<div class="stat admins-stat d-flex bg-danger text-light mb-3">
				<div class="icon d-flex justify-content-center align-items-center px-3">
					<i class="las la-user-tie"></i>
				</div>
				<div class="data flex-grow-1 p-4">
					<h4>Admins</h4>
					<span><?php echo $db->count( 'users', 'role', 1 ) ?></span>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<!-- Number of simple users -->
			<div class="stat users-stat d-flex bg-success text-light mb-3">
				<div class="icon d-flex justify-content-center align-items-center px-3">
					<i class="las la-user"></i>
				</div>
				<div class="data flex-grow-1 p-4">					
					<h4>Users</h4>
					<span><?php echo $db->count( 'users', 'role', 0 ) ?></span>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="card">
				<div class="card-header fw-bold">
					Other statistics
				</div>
				<ul class="list-group list-group-flush mb-3 bg-light">
					<li class="list-group-item">
						<?php
							$last_user = $db->query( "SELECT username FROM users ORDER BY id DESC LIMIT 1" )['username'];
							echo '<strong>' . $last_user . '</strong> is the last registered member of our site.';
						?>
					</li>
					<li class="list-group-item">
						<?php
							$last_user = $db->query( "SELECT username FROM users ORDER BY updated_at DESC LIMIT 1" )['username'];
							echo '<strong>' . $last_user . '</strong> is the last one how updated his account.';
						?>
					</li>
					<li class="list-group-item">
						<?php
							echo "There's <strong>" . $db->count( 'profiles', 'gender', 1 ) . "</strong> Male registered member in our website";
						?>
					</li>
					<li class="list-group-item">
						<?php
							echo "There's <strong>" . $db->count( 'profiles', 'gender', 0 ) . "</strong> Female registered member in our website";
						?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="control-users mt-3">
	<?php include 'users-table.php'; ?>
</div>
<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		// Delete users
		if ( isset( $_POST['delete'] ) ) {
			$user_id = filter_var( $_POST['user_id'], FILTER_SANITIZE_NUMBER_INT );
			// Prevent removing logged user
			if ( $user_id == $_SESSION['user_id'] ) {
				$admin_error[] = '
					You can not remove your account 
					<strong>(' . $_SESSION['username'] . ') </strong>
					using this method
					click <a class="text-danger fw-bold" href="?page=profile">here</a> 
					to remove your account.
					';
			} else {
				// Remove account
				$delete_user = $db->delete( 'users', $user_id );
				if ( $delete_user ) {
					$success_msg = 'The record has been deleted successfully';
				}
			}
		}
		// Change role form
		if ( isset( $_POST['role'] ) ) {
			$user_id = filter_var( $_POST['user_id'], FILTER_SANITIZE_NUMBER_INT );
			$role = filter_var( $_POST['role'], FILTER_SANITIZE_NUMBER_INT );
			// Toggle role ( if user make it admin, if admin make it user )
			$updated_role = $role == 0 ? 1 : 0;
			$change_role = $db->query( "UPDATE users SET role = :role WHERE id = :id", [$updated_role, $user_id] );
			$success_msg = 'The record has been updated successfully';
		}
	}
	// Get all users
	$users = $db->get_all( 'users' );
?>

<h3 class="title">Control users</h3>

<?php 
	form_errors( ( isset( $admin_error ) ? $admin_error : [] ) );
	success_msg( ( isset( $success_msg ) ? $success_msg : '' ) );
?>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>#ID</th>
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
			<th>registered at</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ( $users as $user ) {
				$role = $user['role'] == 0 ? 'User' : 'Admin';
				?>
					<tr class="<?php echo $user['id'] == $_SESSION['user_id'] ? 'bg-dark text-light current-user' : ''; ?>">
						<th><?php echo $user['id'] ?></th>
						<td><?php echo $user['username'] ?></td>
						<td><?php echo $user['email'] ?></td>
						<td class="<?php echo $role == 'Admin' ? 'bg-danger text-light' : ''; ?>"><?php echo $role  ?></td>
						<td><?php echo $user['created_at'] ?></td>
						<td class="d-flex">
							<form class="me-1" action="<?php echo $_SERVER['PHP_SELF'] . '?page=dashboard'; ?>" method="post">
								<input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
								<input type="hidden" name="delete" value="1">
								<button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="las la-trash"></i></button>
							</form>
							<form class="me-1" action="<?php echo $_SERVER['PHP_SELF'] . '?page=dashboard'; ?>" method="post">
								<input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
								<input type="hidden" name="role" value="<?php echo $user['role'] ?>">							
								<button title="Toggle roles" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?')"><i class="las la-user"></i></button>
							</form>
							<a href="?page=profile&id=<?php echo $user['id'] ?>" class="btn btn-success btn-sm"><i class="las la-edit"></i></a>
						</td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
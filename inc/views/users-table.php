<?php
	$users = $db->get_all( 'users' );
?>

<h3 class="title">Control users</h3>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>#ID</th>
			<th>Username</th>
			<th>Email</th>
			<th>registered at</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ( $users as $user ) {
				?>
					<tr>
						<th><?php echo $user['id'] ?></th>
						<td><?php echo $user['username'] ?></td>
						<td><?php echo $user['email'] ?></td>
						<td><?php echo $user['created_at'] ?></td>
						<td class="d-flex">
							<form class="me-1" action="<?php echo $_SERVER['PHP_SELF'] . '?page=dashboard'; ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $user['id'] ?>">
								<button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="las la-trash"></i></button>
							</form>
							<a href="?page=profile&id=<?php echo $user['id'] ?>" class="btn btn-success btn-sm"><i class="las la-edit"></i></a>
						</td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
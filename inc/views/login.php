<h1 class="page-title text-center fw-bolder">Login</h1>
<div class="d-flex justify-content-center">
	<form class="form login-form w-50" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="mb-3">
			<label for="emailInput" class="form-label fw-bold">Email address</label>
			<input id="emailInput" class="form-control" type="email" name="email" placeholder="email@email.com" aria-describedby="emailHelp" autofocus required>
		</div>
		<div class="mb-3">
			<label for="passwordInput" class="form-label fw-bold">Password</label>
			<input id="passwordInput" class="form-control" type="password" name="password" placeholder="Your password" required>
		</div>
		<input type="submit" class="btn btn-primary" value="login">
	</form>
</div> <!-- .d-flex -->
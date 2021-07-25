<?php
	include_once dirname( __FILE__, 2 ) . DIRECTORY_SEPARATOR . 'init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Homepage</title>
	<!-- Our CSS files -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/line-awesome.min.css">
	<link rel="stylesheet" href="assets/css/lr.css">
</head>
<body>
	<!-- Start our header -->
	<header class="site-header">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="/"><?php echo APP_NAME; ?></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#lrNavbar" aria-controls="lrNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="lrNavbar">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="#">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/?page=signup">Signup</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- End our header -->
	<!-- Start our content -->
	<section class="site-content py-5">
		<div class="container">
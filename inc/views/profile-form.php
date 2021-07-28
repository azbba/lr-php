<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if ( isset( $_POST['profile_form'] ) && isset( $_POST['lform'] ) ) {
			// Profile validation
			$firstname		= filter_var( $_POST['firstname'], FILTER_SANITIZE_STRING );
			$lastname		= filter_var( $_POST['lastname'], FILTER_SANITIZE_STRING );
			$bio				= filter_var( $_POST['bio'], FILTER_SANITIZE_STRING );
			$gender			= filter_var( $_POST['gender'], FILTER_SANITIZE_NUMBER_INT );
			$birthdate		= filter_var( $_POST['birthdate'], FILTER_SANITIZE_STRING );
			$phone_number	= filter_var( $_POST['phone_number'], FILTER_SANITIZE_STRING );
			$address			= filter_var( $_POST['address'], FILTER_SANITIZE_STRING );
			$city				= filter_var( $_POST['city'], FILTER_SANITIZE_STRING );
			$country			= filter_var( $_POST['country'], FILTER_SANITIZE_STRING );
			$code_postal	= filter_var( $_POST['code_postal'], FILTER_SANITIZE_NUMBER_INT );

			// Start our validation
			$firstname_errors 	= $validate->validate_length( 'First name', $firstname, 50 );
			$lastname_errors 		= $validate->validate_length( 'Last name', $lastname, 50 );
			$bio_errors 			= $validate->validate_length( 'Bio', $bio, 255 );
			$gender_errors 		= $validate->validate_gender( $gender );
			$birthdate_errors 	= $validate->validate_birthdate( $birthdate );
			$phone_errors 			= $validate->validate_phone_number( $phone_number );
			$address_errors 		= $validate->validate_length( 'Address', $address, 255 );
			$city_errors 			= $validate->validate_length( 'City', $city, 100 );
			$country_errors 		= $validate->validate_length( 'Country', $country, 50 );
			$code_postal_errors 	= $validate->validate_postal_code( $code_postal );
			
			// Check if there's no errors
			if ( $validate->error_count == 0 ) {
				// Update columns
				$columns = [
					'firstname'		=> $firstname,
					'lastname'		=> $lastname,
					'bio'				=> $bio,
					'gender'			=> $gender,
					'birthdate'		=> $birthdate,
					'phone_number'	=> $phone_number,
					'address'		=> $address,
					'city'			=> $city,
					'country'		=> $country,
					'code_postal'	=> $code_postal
				];
				$update = $db->update( 'profiles', $columns, $_SESSION['user_id'] );
				if ( $update ) {
					// Always true because updated_at column updated automatically, every time we submit the form 
					$success_msg = 'The <strong>Profile</strong> has been updated successfully';
					/*
					// Refersh the page if you use join() method.
					// Refersh the page to display new data
					// Number of seconds before refresh the page
					$seconds = 3;
					$success_msg = 'The <strong>Profile</strong> has been updated successfully, Refresh in <span id="refershCounter" class="fw-bold" data-seconds="' . $seconds . '">'. $seconds .'</span> seconds';
					// Refresh the page
					header( "Refresh:$seconds" );
					*/
				}
			}
		}
	}
	// Get profile data
	$user_data = $db->get_record( 'profiles', 'user_id', $_SESSION['user_id'] );
?>

<form class="form profile-form" action="<?php echo $_SERVER['PHP_SELF'] . '?page=profile&form=profile'; ?>" method="post" autocomplete="off">
	<h3 class="form-title">Profile information</h3>
	<?php success_msg( ( isset( $success_msg ) ? $success_msg : '' ) ); ?>
	<input type="hidden" name="profile_form" value="1">
	<div class="mb-3">
		<label for="firstName" class="form-label fw-bold">First name</label>
		<input id="firstName" class="form-control" type="text" name="firstname" placeholder="john doe" value="<?php echo $user_data['firstname']; ?>">
		<?php form_errors( ( isset( $firstname_errors ) ? $firstname_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="lastName" class="form-label fw-bold">Last name</label>
		<input id="lastName" class="form-control" type="text" name="lastname" placeholder="john doe" value="<?php echo $user_data['lastname']; ?>">
		<?php form_errors( ( isset( $lastname_errors ) ? $lastname_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="bioTxt" class="form-label fw-bold">bio</label>
		<textarea id="bioTxt" class="form-control" name="bio" placeholder="Tape something about you"><?php echo $user_data['bio'] ?></textarea>
		<?php form_errors( ( isset( $bio_errors ) ? $bio_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="gender" class="form-label fw-bold">Gender</label>
		<select name="gender" id="gender" class="form-control">
			<option value="0" <?php echo $user_data['gender'] == 0 && ! is_null( $user_data['gender'] ) ? 'selected' : ''; ?>>Female</option>
			<option value="1" <?php echo $user_data['gender'] == 1 ? 'selected' : ''; ?>>Male</option>
		</select>
		<?php form_errors( ( isset( $gender_errors ) ? $gender_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="birthdate" class="form-label fw-bold">Birthdate</label>
		<input id="birthdate" class="form-control" type="date" name="birthdate" value="<?php echo $user_data['birthdate'] ?>">
		<?php form_errors( ( isset( $birthdate_errors ) ? $birthdate_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="phone" class="form-label fw-bold">Phone number</label>
		<input id="phone" class="form-control" type="tel" name="phone_number" value="<?php echo $user_data['phone_number'] ?>">
		<?php form_errors( ( isset( $phone_errors ) ? $phone_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="address" class="form-label fw-bold">Address</label>
		<input id="address" class="form-control" type="text" name="address" value="<?php echo $user_data['address'] ?>">
		<?php form_errors( ( isset( $address_errors ) ? $address_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="city" class="form-label fw-bold">City</label>
		<input id="city" class="form-control" type="text" name="city" value="<?php echo $user_data['city'] ?>">
		<?php form_errors( ( isset( $city_errors ) ? $city_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="country" class="form-label fw-bold">Country</label>
		<input id="country" class="form-control" type="text" name="country" value="<?php echo $user_data['country'] ?>">
		<?php form_errors( ( isset( $country_errors ) ? $country_errors : [] ) ); ?>
	</div>
	<div class="mb-3">
		<label for="codePostal" class="form-label fw-bold">Code postal</label>
		<input id="codePostal" class="form-control" type="number" name="code_postal" value="<?php echo $user_data['code_postal'] ?>">
		<?php form_errors( ( isset( $code_postal_errors ) ? $code_postal_errors : [] ) ); ?>
	</div>
	<input type="submit" class="btn btn-danger" name="lform" value="Update profile">
</form>
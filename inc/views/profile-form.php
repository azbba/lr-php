<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if ( isset( $_POST['profile_form'] ) && isset( $_POST['lform'] ) ) {
			// Profile validation
		}
	}
?>

<form class="form profile-form" action="<?php echo $_SERVER['PHP_SELF'] . '?page=profile&form=profile'; ?>" method="post" autocomplete="off">
	<p class="text-muted">Profile information</p>
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
			<option value="0" <?php echo $user_data['gender'] == 0 ? 'selected' : ''; ?>>Female</option>
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
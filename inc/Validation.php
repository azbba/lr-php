<?php
/**
 * User input Validation 
*/

class Validation {
	// Database connection
	private Database $db;
	// Rules
	private const MAX_USERNAME_LENGTH = 50;
	private const MIN_USERNAME_LENGTH = 5;

	private const MAX_PASSWORD_LENGTH = 255;
	private const MIN_PASSWORD_LENGTH = 8;

	private const MAX_PHONE_NUMBER_LENGTH = 15;
	private const MAX_POSTAL_CODE_LENGTH = 5;

	public int $error_count = 0;

	public function __construct( Database $db ) {
		$this->db = $db;
	}

	/**
	 * error_counter()
	 * Method to count form errors
	 * 
	 * if $count == 0 that's mean there's no validation errors.
	 * if $count > 0 that's mean there's validation errors.
	 * 
	 * 
	 * @param int $count
	*/
	private function error_counter( int $count ) {
		$this->error_count += $count;
	}

	/**
	 * Validate username input 
	 * @param string $username
	*/

	public function validate_username( string $username, bool $singup = true, bool $update = false, int $id = 0 ) {
		$errors = [];
		// Check if the user didn't enter the username
		if ( empty( $username ) ) {
			$errors[] = 'The <strong>Username</strong> field is required';
		}
		// Username length validation
		if ( strlen( $username ) < self::MIN_USERNAME_LENGTH || strlen( $username ) > self::MAX_USERNAME_LENGTH ) {
			$errors[] = 'The <strong>Username</strong> field must be between ' . self::MIN_USERNAME_LENGTH . ' and ' . self::MAX_USERNAME_LENGTH . ' characters.';
		}
		// Validate only on signup form
		if ( $singup ) {
			if ( $this->db->unique_record( 'users', 'username', $username ) ) {
				$errors[] = 'This <strong>Username</strong> already exists.';
			}
		}
		if ( $update ) {
			// Validate user input when update the account.
			if ( $this->db->record_not_in( 'users', 'username', $username, $id ) ) {
				$errors[] = 'This <strong>Username</strong> already exists.';
			}
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * Validate email input 
	 * @param string $email
	*/

	public function validate_email( string $email, bool $update = false, int $id = 0 ) {
		$errors = [];
		if ( empty( $email ) ) {
			$errors[] = 'The <strong>Email</strong> field is required';
		}
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) === false ) {
			$errors[] = 'The <strong>Email</strong> field must be a valid email address.';
		}
		if ( ! $update ) {
			if ( $this->db->unique_record( 'users', 'email', $email ) ) {
				$errors[] = 'This <strong>Email</strong> already exists.';
			}
		}
		if ( $update ) {
			// Validate user input when update the account.
			if ( $this->db->record_not_in( 'users', 'email', $email, $id ) ) {
				$errors[] = 'This <strong>Email</strong> already exists.';
			}
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * Validate password input 
	 * @param string $password
	*/

	public function validate_password( string $password, bool $singup = true ) {
		$errors = [];
		if ( empty( $password ) ) {
			$errors[] = 'The <strong>Password</strong> field is required';
		}
		if ( $singup ) {
			if ( strlen( $password ) < self::MIN_PASSWORD_LENGTH || strlen( $password ) > self::MAX_PASSWORD_LENGTH ) {
				$errors[] = 'The <strong>Password</strong> field must be between ' . self::MIN_PASSWORD_LENGTH . ' and ' . self::MAX_PASSWORD_LENGTH . ' characters.';
			}
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * Validate re-password input 
	 * @param string $repassword
	*/

	public function validate_repassword( string $password, string $repassword ) {
		$errors = [];
		if ( empty( $password ) ) {
			$errors[] = 'The <strong>Password</strong> field is required';
		}
		if ( $password !== $repassword ) {
			$errors[] = 'The <strong>Passwords</strong> do not match';
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * 
	*/

	public function validate_oldpassword( string $oldpassword, string $oldpass, string $field = 'Old Password' ) {
		$errors = [];
		if ( empty( $oldpassword ) ) {
			$errors[] = 'The <strong>' . $field . '</strong> field is required';
		}
		if ( !empty($oldpassword) && ! password_verify( $oldpassword, $oldpass ) ) {
			$errors[] = 'The <strong>' . $field . '</strong> do not match with our records.';
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * Validate length
	 * @param string $name 
	*/

	public function validate_length( string $field, string $value, int $length ) {
		$errors = [];
		if ( strlen( $value ) > $length ) {
			$errors[] = 'The <strong> ' . $field . ' </strong> must be less than ' . $length . ' characters.';
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : []; 
	}

	/**
	 * validate boolean
	 * @param int $gender
	*/

	public function validate_gender( int $gender ) {
		$errors = [];
		$options = [
			"options" => [
				"min_range" => 0 ,
				"max_range"=> 1
			]
		];
		if ( filter_var( $gender, FILTER_VALIDATE_INT, $options ) === false ) {
			$errors[] = 'The <strong>Gender</strong> must be male or female.';
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : []; 
	}

	/**
	 * Validate birthdate 
	 * @param string $birthdate
	*/

	public function validate_birthdate( string $birthdate ) {
		$errors = [];
		if ( !empty( $birthdate ) ) {
			$date = explode('-', $birthdate);
			if ( checkdate( $date[1], $date[2], $date[0] ) === false ) {
				$errors[] = 'The <strong>birth date</strong>must be valid date.';
			}
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : []; 
	}

	/**
	 * Validate phone number
	 * @param string $phone_number
	*/

	public function validate_phone_number( string $phone_number ) {
		$errors = [];
		if ( !empty( $phone_number ) ) {
			if( preg_match("/^[0-9 +]/", $phone_number) < 1 ) {
				$errors[] = 'The <strong>Phone number</strong> must be valide phone number.';
			}
			if ( strlen( $phone_number ) > self::MAX_PHONE_NUMBER_LENGTH ) {
				$errors[] = 'The <strong>Phone number</strong> must be less than ' . self::MAX_PHONE_NUMBER_LENGTH . ' Digit.';
			}
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : []; 
	}

	/**
	 * validate postal code
	 * @param int $postal_code 
	*/

	public function validate_postal_code( string $postal_code ) {
		$errors = [];
		if ( !empty( $postal_code ) ) {
			if ( strlen( $postal_code ) != self::MAX_POSTAL_CODE_LENGTH ) {
				$errors[] = 'The <strong>Postal code</strong> must be equal to ' . self::MAX_POSTAL_CODE_LENGTH . ' Digit.';
			}
			if( preg_match("/^[0-9]/", $postal_code) < 1 ) { 
				// filter_var will sanitize the $postal_code.
				// This error will not appear ever.
				// Only for an extra validation.
				$errors[] = 'The <strong>Postal code</strong> must be a number.';
			}
		}
		$this->error_counter( count( $errors ) );
		return ! empty( $errors ) ? $errors : [];
	}

}
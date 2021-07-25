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

	public function __construct( Database $db ) {
		$this->db = $db;
	}

	/**
	 * Validate username input 
	 * @param string $username
	*/

	public function validate_username( string $username ) {
		$errors = [];
		// Check if the user didn't enter the username
		if ( empty( $username ) ) {
			$errors[] = 'The <strong>Username</strong> field is required';
		}
		// Username length validation
		if ( strlen( $username ) < self::MIN_USERNAME_LENGTH || strlen( $username ) > self::MAX_USERNAME_LENGTH ) {
			$errors[] = 'The <strong>Username</strong> field must be between ' . self::MIN_USERNAME_LENGTH . ' and ' . self::MAX_USERNAME_LENGTH . ' characters.';
		}
		if ( $this->db->unique_record( 'users', 'username', $username ) ) {
			$errors[] = 'This <strong>Username</strong> already exists.';
		}
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * Validate email input 
	 * @param string $email
	*/

	public function validate_email( string $email ) {
		$errors = [];
		if ( empty( $email ) ) {
			$errors[] = 'The <strong>Email</strong> field is required';
		}
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) === false ) {
			$errors[] = 'The <strong>Email</strong> field must be a valid email address.';
		}
		if ( $this->db->unique_record( 'users', 'email', $email ) ) {
			$errors[] = 'This <strong>Email</strong> already exists.';
		}
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * Validate password input 
	 * @param string $password
	*/

	public function validate_password( string $password ) {
		$errors = [];
		if ( empty( $password ) ) {
			$errors[] = 'The <strong>Password</strong> field is required';
		}
		if ( strlen( $password ) < self::MIN_PASSWORD_LENGTH || strlen( $password ) > self::MAX_PASSWORD_LENGTH ) {
			$errors[] = 'The <strong>Password</strong> field must be between ' . self::MIN_PASSWORD_LENGTH . ' and ' . self::MAX_PASSWORD_LENGTH . ' characters.';
		}
		return ! empty( $errors ) ? $errors : [];
	}

	/**
	 * Validate re-password input 
	 * @param string $repassword
	*/

	public function validate_repassword( string $password, string $repassword ) {
		$errors = [];
		if ( $password !== $repassword ) {
			$errors[] = 'The <strong>Passwords</strong> do not match';
		}
		return ! empty( $errors ) ? $errors : [];
	}

}
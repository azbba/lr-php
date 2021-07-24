<?php

/**
 * Database class
 * 
 * Connect to database
 * CRUD
*/

class Database {

	// PDO object
	protected $db;
	
	/**
	 * Connection to database 
	*/
	public function __construct() {
		try {
			$dsn =  'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';';
			$options = [
				PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC,
				PDO::MYSQL_ATTR_INIT_COMMAND 	=> 'SET NAMES ' . DB_CHARSET,
				PDO::ATTR_EMULATE_PREPARES		=> false
			];
			$this->db = new PDO( $dsn, DB_USER, DB_PASS, $options );
		} catch ( PDOException $e ) {
			echo $e->getMessage();
		}
	}

	/**
	 * Login method
	 * @param String $login username or email
	 * @param String $password Hashed password
	 * @return Array if succes Boolean false if failure
	*/
	public function login( string $login, string $password ) {
		$stmt = $this->db->prepare( 'SELECT * FROM users WHERE username = :login LIMIT 1' );
		$stmt->bindValue( ':login', $login );
		$stmt->execute();
		// Check if there's results with this name
		if ( $stmt->rowCount() > 0 ) {
			$result = $stmt->fetch();
			// Check if the passwords are matches
			if ( password_verify( $password, $result['password'] ) ) {
				return $result;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
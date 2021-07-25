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
		$stmt = $this->db->prepare( 'SELECT * FROM users WHERE (username = ? OR email = ?) LIMIT 1' );
		$stmt->bindValue( 1, $login );
		$stmt->bindValue( 2, $login );
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

	/**
	 * signup method
	 * Register a new user, and create his profile
	 * 
	 * @param string $username
	 * @param string $email
	 * @param string $password hashed
	*/

	public function signup( string $username, string $email, string $password ) {
		try {
			$this->db->beginTransaction();
			$stmt = $this->db->prepare( "INSERT INTO users (username, email, password) VALUES (:uname, :email, :pass)" );
			$stmt->execute([
				':uname'	=> $username,
				':email'	=> $email,
				':pass'	=> $password
			]);
			$count = $stmt->rowCount();
			if ( $count > 0 ) {
				// Create profile record
				$last_id = $this->db->lastInsertId();
				$profile = $this->db->prepare( "INSERT INTO profiles (user_id) values (:userid)" );
				$profile->bindValue( ':userid', $last_id );
				$profile->execute();
				$profile_count = $profile->rowCount();
			}
			$this->db->commit();
			return ( $count > 0 && isset( $profile_count ) && $profile_count > 0 ? true : false);
		} catch ( PDOException $e ) {
			$this->db->rollBack();
			echo $e->getMessage();
		}
	}

	/**
	 * unique_record
	 * Check if value exsits in unique column
	 * 
	 * @param string $table_name
	 * @param string $column
	 * @param string $value 
	*/

	public function unique_record( string $table_name, string $column, string $value ) {
		$stmt = $this->db->prepare( "SELECT $column FROM $table_name WHERE $column = ?" );
		$stmt->bindValue(1, $value);
		$stmt->execute();
		return $stmt->rowCount() > 0 ? true : false;
	}

	/**
	 * get_record()
	 * 
	 * @param string $table_name
	 * @param string $column
	 * @param string $value
	*/

	public function user_info( string $table_name, string $column, string $value ) {
		$stmt = $this->db->prepare( "SELECT * FROM $table_name where $column = ? LIMIT 1" );
		$stmt->bindValue(1, $value);
		$stmt->execute();
		return $stmt->rowCount() > 0 ? $stmt->fetch() : false;
	}

	/**
	 * join
	 * join two tables
	 * 
	 * @param string $table1
	 * @param string $table2
	 * @param string $column1
	 * @param string $column2
	 * @param int $where
	*/

	public function join( string $table1, string $table2, string $column1, string $column2, int $where) {
		$stmt = $this->db->prepare( "SELECT * FROM $table1 INNER JOIN $table2 ON $table1.$column1 = $table2.$column2 WHERE $table1.$column1 = ?" );
		$stmt->bindValue( 1, $where );
		$stmt->execute();
		return $stmt->rowCount() > 0 ? $stmt->fetch() : false;
	}

}
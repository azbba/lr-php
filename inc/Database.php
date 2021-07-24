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

}
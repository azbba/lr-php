<?php
/**
 * Application Initialization
 * 
 * This file must be included in all files
 * By default we included this file in [ inc/layouts/header.php ]
 * If you do not use that file, you must include it manually in your file.
*/

include_once 'config.php';

// Error mode
error_reporting( ( DEBUG_MODE === true ? E_ALL : 0 ) );

// Set the default time zone
date_default_timezone_set( TIME_ZONE );

// Connection class
include_once APP_ROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'Database.php';
$db = new Database();
<?php

// Application info
define( 'APP_NAME', 'lr_app' );
define( 'APP_ROOT', dirname( __FILE__, 2 ) );

// MySQL settings

define( 'DB_HOST', 'localhost' );   // Hostname
define( 'DB_NAME', 'lr_php' );      // Database name
define( 'DB_PORT', '3306' );      // Database port
define( 'DB_USER', 'root' );        // Database username
define( 'DB_PASS', '' );            // Database password
define( 'DB_CHARSET', 'utf8' );     // Database password

/**
  * Debug Mode
  * true === development, false === droduction
  * When APP in development mode, will be shown all possible errors.
**/

define( 'DEBUG_MODE', true ); // true == development

// Timezone and localization
define( 'TIME_ZONE', 'Africa/Algiers' );
define( 'APP_LOCAL', 'en_US' );
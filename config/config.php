<?php

error_reporting( E_ALL ^E_NOTICE );

define( 'PROJECT_NAME', 'skeleton' ); // change me
define( 'TIMER', microtime( true ) );
define( 'PROJECT_PATH', substr( __file__, 0, strlen( __file__ ) - 18 ) );
define( 'SMARTY_COMPILE_DIR', '/tmp/'. PROJECT_NAME );

if( !file_exists( SMARTY_COMPILE_DIR ) )
	mkdir( SMARTY_COMPILE_DIR );

define( 'SMARTY_DIR', '/var/www/include/smarty/' );
define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH ."/templates/" );
define( 'PRODUCTION', false );

define( 'DB_TYPE', 'mysql' );
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', '' );
define( 'DB_USERNAME', '' );
define( 'DB_PASSWORD', '' );

require_once( '/var/www/include/smarty/Smarty.class.php' );
require_once( '/var/www/include/class/Entity.class.php' );

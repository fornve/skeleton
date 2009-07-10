<?php

error_reporting( E_ALL ^E_NOTICE );
define( 'TIMER', microtime( true ) );
define( 'PROJECT_PATH', substr( __file__, 0, strlen( __file__ ) - 18 ) );

/* configuration begins */
define( 'PROJECT_NAME', 'skeleton' ); // change me
define( 'SMARTY_COMPILE_DIR', '/tmp/'. PROJECT_NAME );

define( 'INCLUDE_PATH', '/var/www/include/' );
define( 'SMARTY_DIR', INCLUDE_PATH .'smarty/' );
define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH ."/templates/" );
define( 'PRODUCTION', false );

define( 'DB_TYPE', 'mysql' );
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', '' );
define( 'DB_USERNAME', '' );
define( 'DB_PASSWORD', '' );

/* end of configuration */

if( !file_exists( INCLUDE_PATH .'/class/Entity.class.php' ) )
{
	die('LiteEntityLib not found, please follow <a href="http://www.sum-e.com/Page/Installation/#LiteEntityLib">instructions</a> to install it.');
}
elseif( !file_exists( INCLUDE_PATH .'/smarty/Smarty.class.php' ) )
{
	die('Smarty not found, please follow <a href="http://www.sum-e.com/Page/Installation/#Smarty">instructions</a> to install it.');
}

require_once( INCLUDE_PATH .'smarty/Smarty.class.php' );

if( !file_exists( SMARTY_COMPILE_DIR ) )
	mkdir( SMARTY_COMPILE_DIR );

function __autoload( $name )
{
	$path_array = array( 'classes/', 'entities/', 'controllers/', INCLUDE_PATH .'class/' );

	foreach( $path_array as $path )
	{
		if( file_exists( $path . $name .'.class.php' ) )
		{
			include_once( $path . $name .'.class.php' );
			return true;
		}
	}
}


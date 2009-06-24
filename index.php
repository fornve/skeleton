<?php

if( !file_exists( '/var/www/include/class/Entity.class.php' ) )
{
		die('LiteEntityLib not found, please follow <a href="http://www.sum-e.com/wiki/index.php5/LiteEntityLib">instructions</a> to install it.');
}

require_once( 'config/config.php' );

function __autoload( $name )
{
	$path_array = array( 'classes/', 'entites/', 'controllers/', '/var/www/include/class/' );

	foreach( $path_array as $path )
	{
		if( file_exists( $path . $name .'.class.php' ) )
		{
			include_once( $path . $name .'.class.php' );
			return true;
		}
	}
}

session_start();
$www = new IndexController();
$www->Dispatch();

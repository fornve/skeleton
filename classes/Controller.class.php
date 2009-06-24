<?php

/**
 * @package shop
 * @subpackage framework
 */
class Controller
{
	function __construct()
	{
		Controller::Startup();

		//$this->entity = new Entity;
		$this->smarty = new Smarty;
		$this->smarty->compile_dir = SMARTY_COMPILE_DIR;
		$this->smarty->template_dir = SMARTY_TEMPLATES_DIR;

		if( !file_exists( $this->smarty->compile_dir ) )
			mkdir( $this->smarty->compile_dir );
	}

	function dispatch( $default )
	{
		$uri = explode( '?', $_SERVER['REQUEST_URI'] );
		$input = explode( '/', $uri[ 0 ] );

		// rewrite rule for numeric ads
		if( is_numeric( $input[ 1 ] ) )
		{
			$input[ 3 ] = $input[ 1 ];
			$input[ 1 ] = 'Todo';
			$input[ 2 ] = 'View';
		}
		elseif( $input[ 1 ] == 'robots.txt' )
		{
			$input[ 1 ] = 'Index';
			$input[ 2 ] = 'Robots';
		}

		if( strlen( $input[ 1 ] ) < 1 ) // default Controller
			$input[ 1 ] = 'Index';

		if( strlen( $input[ 2 ] ) < 1 ) // default function
			$input[ 2 ] = 'Index';

		$this->controller = $input[ 1 ];
		$this->action = $input[ 2 ];
		$controller_name = "{$input[1]}Controller";

		if( class_exists( $controller_name ) )
		{
			$controller = new $controller_name;

			$method = $input[ 2 ];

			if( strlen( $method ) == 0 )
				$method = 'Index';

			if( method_exists( get_class( $controller ), $method ) ) // check if property exists
			{
				$controller->$method( $input[ 3 ], $input[ 4 ] );
			}
			else
			{
				self::Redirect( "/Index/NotFound" );
			}
		}
		else
		{
			self::Redirect( "/Index/NotFound" );
		}
	}

	function assign( $variable, $value )
	{
		$this->smarty->assign( $variable, $value );
	}

	function fetch( $template, $dir = null )
	{
		if( !$dir ) $dir = SMARTY_TEMPLATES_DIR;
		$output = $this->smarty->fetch( $dir . $template );
		return $output;
	}

	function decorate( $template, $dir = null )
	{
		if( !$dir ) $dir = SMARTY_TEMPLATES_DIR;

		$content = $this->smarty->fetch( $dir . $template );

		if( !filter_input( INPUT_GET, 'ajax' ) )
		{
			$this->assign( 'content', $content );

			$this->PreDecorate();
			$content = $this->smarty->fetch( $dir .'decoration.tpl' );
			$this->PostDecorate();
		}

		return $content;
	}

	static function Startup()
	{
		define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH ."/templates/" );
	}

    function PreDecorate()
	{
		if( !PRODUCTION )
		{
			$generated = floor ( 10000 * ( microtime( true ) - TIMER ) ) / 10000;
			$this->smarty->assign( 'generated', $generated );
			$this->smarty->assign( 'entity_query', $_SESSION[ 'entity_query' ] );
			unset( $_SESSION[ 'entity_query' ] );
		}
    }

    function PostDecorate()
    {
		unset( $_SESSION[ 'user_notification' ] );
    }

    static function Redirect( $url )
    {
        header( "Location: $url" );
        exit;
	}

	static function RedirectReferer()
	{
		self::Redirect( $_SERVER[ 'HTTP_REFERER' ] );
	}
}


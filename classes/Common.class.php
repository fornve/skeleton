<?php

class Common
{

	public static function HttpPost( $endpoint, $postdata )
	{
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endpoint );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postdata );
		$return = curl_exec( $ch );
		curl_close( $ch );

		return $return;
	}

	static function Inputs( $array, $input_type = INPUT_GET )
	{
		$input = new stdClass;

		foreach ( $array as $key )
		{
			$input->$key = addslashes( filter_input( $input_type, $key ) );
		}

		return $input;
	}

}
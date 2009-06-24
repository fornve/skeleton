<?php

class EuromillionResult
{
	public $cloud_a; // numbers
	public $cloud_b; // stars

	function __construct( $draws )
	{
		if( $draws )
		{
			$this->draws = $draws;
			$this->GenerateCloud_A();
			$this->GenerateCloud_B();
		}
	}

	function GenerateCloud_A()
	{
		for( $i = 1; $i <= 50; $i++ )
		{
			foreach( $this->draws as $draw )
			{
				foreach( $draw->numbers_a as $key => $draw_number )
				{
					if( $draw_number == $i )
					{
						$item[ $draw->id ][ $i ] = 1;
						$this->counter_a[ $i ] += 1;
					}
					elseif( !$item[ $draw->id ][ $i ] ) // condition because we don't want to overwrite set in loop 1
					{
						$this->counter_a[ $i ] += 0;
						$item[ $draw->id ][ $i ] = null;
					}
				}
			}
		}

		$this->cloud_a = $item;
	}

	function GenerateCloud_B()
	{
		for( $i = 1; $i <= 9; $i++ )
		{
			foreach( $this->draws as $draw )
			{
				foreach( $draw->numbers_b as $key => $draw_number )
				{
					if( $draw_number == $i )
					{
						$item[ $draw->id ][ $i ] = 1;
						$this->counter_b[ $i ] += 1;
					}
					elseif( !$item[ $draw->id ][ $i ] ) // condition because we don't want to overwrite set in loop 1
					{
						$this->counter_b[ $i ] += 0;
						$item[ $draw->id ][ $i ] = null;
					}
				}
			}
		}

		$this->cloud_b = $item;
	}

}
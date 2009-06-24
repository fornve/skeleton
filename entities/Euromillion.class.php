<?php

class Euromillion extends Entity
{
	protected $schema = array( 'id', 'date', 'draw_numbers' );

	static function Retrieve( $id )
	{
		$query = "SELECT * FROM euromillion WHERE id = ?";
		$entity = new Entity();
		$object = $entity->GetFirstResult( $query, array( $id ), __CLASS__ );
		if( !$object )
			return null;

		$object->SplitNumbers();
		return $object;
	}

	static function GetAll( $limit )
	{
		$query = "SELECT * FROM euromillion ORDER BY date DESC";
		$entity = new Entity();
		$result = $entity->Collection( $query, null, __CLASS__, $limit );
		
		if( $result ) foreach( $result as $draw )
		{
			$draw->SplitNumbers();
			$collection[] = $draw;
		}

		return $collection;
	}

	private function SplitNumbers()
	{
		$numbers = explode( ',', $this->draw_numbers );
		if( $numbers ) foreach ( $numbers as $number )
		{
			$i++;

			if( $i < 6 )
				$this->numbers_a[] = (int) $number;
			else
				$this->numbers_b[] = (int) $number;
		}
	}
}
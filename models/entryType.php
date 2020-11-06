<?php

class EntryType
{
	const EVENT = "event";
	const PERSON = "person";
	const PLACE = "place";
	const THING = "thing";
	const NOTE = "note";
	
	private string $value;

	public function __construct(string $v) 
	{
		$this->set($v);
	}

	public function get()
	{
		return $this->value;
	}

	public function set(string $v) 
	{
		if ($v == self::EVENT || $v == self::PERSON || $v == self::PLACE || $v == self::THING || $v == self::NOTE)
		{
			$this->value = $v;
		} 
		else 
		{
			throw new Exception('Invalid entry type.');
		}
	}
}

?>
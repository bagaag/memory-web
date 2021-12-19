<?php

// EntryType represents the category of an Entry.

class EntryType
{
	const EVENT = "event";
	const PERSON = "person";
	const PLACE = "place";
	const THING = "thing";
	
	private string $value;

	public function __construct(string $v) 
	{
		$this->set($v);
	}

	public function get()
	{
		return $this->value;
	}

	public static function isValid(string $v) 
	{
		$v = strtolower($v);
		if ($v == self::EVENT || $v == self::PERSON || $v == self::PLACE || $v == self::THING)
		{
			return true;
		}
		return false;
	}

	public function set(string $v) 
	{
		$v = strtolower($v);
		if (EntryType::isValid($v))
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
<?php
require_once "entryType.php";

class Entry
{
	public string $name = "";
	public string $slug = "";
	public string $description = "";
	public array $tags = array();
	public DateTime $created;
	public DateTime $modified;
	public EntryType $type;
	public ?DateTime $start;
	public ?DateTime $end;
	public string $latitude = "";
	public string $longitude = "";
	public string $address = "";
	public array $custom = array();
	public array $attachments = array();

	public function __construct() {
		$this->created = getdate();
		$this->modified = getdate();
		$this->type = new EntryType('event');
	}

}

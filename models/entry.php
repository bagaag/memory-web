<?php
require_once "global.php";

// Entry represents a peice of content created by the user.

class Entry
{
	public string $path = "";
	public string $name = "";
	public string $slug = "";
	public string $description = "";
	public string $description_html = "";
	public array $tags = array();
	public DateTime $modified;
	public EntryType $type;
	public ?DateTime $start;
	public ?DateTime $end;
	public string $address = "";
	public array $attachments = array();
	public string $edit_url = "";

	public function __construct() {
		// set some defaults for a new entry
		$now = new DateTime();
		$this->created = $now;
		$this->modified = $now;
		$this->type = new EntryType('thing');
	}
}

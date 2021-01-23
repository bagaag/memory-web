<?php
require_once "entryType.php";

// Entry represents a peice of content created by the user.

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
		$now = new DateTime();
		$this->created = $now;
		$this->modified = $now;
		$this->type = new EntryType('event');
	}

}

function createEntry($name, $slug, $type, $tags, $description) {
	$entry = new Entry();
	$entry->name = $name;
	$entry->slug = $slug;
	$entry->type->set($type);
	$entry->tags = $tags;
	$entry->description = $description;
	return $entry;
}
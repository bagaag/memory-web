<?php
require_once "global.php";

// Entry represents a peice of content created by the user.

class Entry
{
	public string $path = "";
	public string $name = "";
	public string $slug = "";
	public string $description = "";
	public array $tags = array();
	public DateTime $created;
	public DateTime $modified;
	public EntryType $type;
	public ?DateTime $start;
	public ?DateTime $end;
	public string $address = "";
	public array $attachments = array();

	public function __construct() {
		// set some defaults for a new entry
		$now = new DateTime();
		$this->created = $now;
		$this->modified = $now;
		$this->type = new EntryType('thing');
	}

	// Static method to create a new entry with given values
	public static function createEntry($name, $slug, $type, $tags, $description) {
		$entry = new Entry();
		$entry->name = $name;
		$entry->slug = $slug;
		$entry->type->set($type);
		$entry->tags = $tags;
		$entry->description = $description;
		return $entry;
	}

	// Static method to read an entry from a markdown file
	public static function fromFile($path) {
		// create entry
		$entry = new Entry();
		$entry->path = $path;
		
		// read file
		$fp = fopen($path, "r");
		$content = fread($fp, filesize($filename));
		$content = standardizeLineBreaks($content);
		fclose($fp);

		// parse file
		$yaml = $this->extractYaml($content);
		$fm = yaml_parse($yaml);
		$entry->description = extractMarkdown($content);

		// set slug and fallback name
		$pathinfo = pathinfo($path);
		$entry->slug = $pathinfo['filename'];
		$entry->name = $pathinfo['filename'];

		// set fields from front-matter
		if (array_key_exists('title', $fm)) 
		{
			$entry->name = $fm['title'];
		} 
		// check for leading H1 if title is absent
		else if (false) {
			if (startsWith($entry->description, '# ')) {
				$firstLines = explode(MEM_EOL, $entry->description, 2);
				$entry->name = preg_replace('^#\s', '', $firstLines[0]);
			}
		}

		// set tags
		if (array_key_exists('tags', $fm) && is_array($fm['tags'])) 
		{
			$entry->tags = $fm['tags'];
		}

		// set dates
		$entry->created = filectime($path); 
		$entry->modified = filemtime($path);
		if (array_key_exists('start')) {
			$start = date_parse($fm['start']);
			if ($start['error_count'] == 0) 
			{
				$entry->start = $start;
			}
		}
		if (array_key_exists('end')) {
			$end = date_parse($fm['end']);
			if ($end['error_count'] == 0) 
			{
				$entry->end = $end;
			}
		}

		// set entry type
		if (array_key_exists('type') && EntryType::isValid($fm['type'])) 
		{
			$entry->type = $fm['type'];
		}

		// set address
		if (array_key_exists('address')) 
		{
			$entry->type = $fm['address'];
		}

		// set attachments
		$dir = $pathinfo['dirname'];
		$parent = pathinfo($dir)['dirname'];
		$assets = $parent . '/assets/' . $entry->slug;
		if (is_dir($assets)) 
		{
			$files = scandir($assets);
			foreach ($files as $file) 
			{
				$attachment = new Attachment($file);
				$entry->attachments[] = $attachment;
			}
		}
	}

	// Returns the yaml section as a string from the top of a markdown file,
	// or NULL if there is no yaml section
	public static function extractYaml($s) 
	{
		$separator = '---' . MEM_EOL;
		$a = explode($separator, $s, 3);
		if (count($a) > 0 && $a[0] === '') {
			return $a[1];
		}
		return NULL;
	}

	// Returns the Markdown portion (everything after the Yaml frontmatter) of the given string
	public static function extractMarkdown($s) 
	{
		$separator = '---' . MEM_EOL;
		$a = explode($separator, $s, 3);
		if (count($a) > 1 && $a[0] === '') {
			return ltrim($a[2]);
		}
		return NULL;
	}

}

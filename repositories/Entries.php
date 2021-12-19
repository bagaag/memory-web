<?php
require_once "models/entry.php";
require_once "models/attachment.php";

class Entries
{
    public $all;
    public $slugs;
	public $Parsedown;


    public function __construct()
    {
		$this->Parsedown = new Parsedown();
        $this->load_entries();
    }

    public function load_entries() 
    {
        $this->all = array();
        $entries_dir = new DirectoryIterator(ENTRIES_PATH);
        foreach ($entries_dir as $fileinfo) {
            if ($fileinfo->getExtension() == 'md') {
                $entry = $this->fromFile($fileinfo->getPathname());
                array_push($this->all, $entry);
                $this->slugs[$entry->slug] = $entry;
            }
        }
    }

	// Creates a new entry with given values
	public function createEntry($name, $slug, $type, $tags, $description) {
		$entry = new Entry();
		$entry->name = $name;
		$entry->slug = $slug;
		$entry->type->set($type);
		$entry->tags = $tags;
		$entry->description = $description;
		return $entry;
	}

	// Reads an entry from a markdown file
	public function fromFile($path) {
		// create entry
		$entry = new Entry();
		$entry->path = $path;
		
		// read file
		$fp = fopen($path, "r");
		$content = fread($fp, filesize($path));
		$content = standardizeLineBreaks($content);
		fclose($fp);

		// parse file
		$yaml = $this->extractYaml($content);
		$fm = yaml_parse($yaml);
		$entry->description = $this->extractMarkdown($content);

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
		else if (startsWith($entry->description, '# ')) 
		{
			$lines = explode(MEM_EOL, $entry->description);
			$entry->name = preg_replace('/^#\s/', '', array_shift($lines));
			$entry->description = implode(MEM_EOL, $lines);
		}

		// convert markdown to html
		$entry->description_html = $this->Parsedown->text($entry->description);

		// set tags
		if (array_key_exists('tags', $fm) && is_array($fm['tags'])) 
		{
			$entry->tags = $fm['tags'];
		}

		// set dates
		$modified = new DateTime();
		$entry->modified = $modified->setTimestamp(filemtime($path));
		if (array_key_exists('start', $fm)) {
			$start = date_parse($fm['start']);
			if ($start['error_count'] == 0) 
			{
				$entry->start = DateTime::createFromFormat('Y-m-d', $start['year'] . '-' . $start['month'] . '-' . $start['day']);
			}
		}
		if (array_key_exists('end', $fm)) {
			$end = date_parse($fm['end']);
			if ($end['error_count'] == 0) 
			{
				$entry->end = DateTime::createFromFormat('Y-m-d', $end['year'] . '-' . $end['month'] . '-' . $end['day']);
			}
		}

		// set address
		if (array_key_exists('address', $fm)) 
		{
			$entry->address = $fm['address'];
		}

		// set entry type
		if (array_key_exists('type', $fm) && EntryType::isValid($fm['type'])) 
		{
			$entry->type = new EntryType($fm['type']);
		}

		// set address
		if (array_key_exists('address', $fm)) 
		{
			$entry->address = $fm['address'];
		}

		// set attachments
		$assets = ATTACHMENTS_PATH . DIRECTORY_SEPARATOR . $entry->slug;
		if (is_dir($assets)) 
		{
			$files = array_slice(scandir($assets), 2); 
			foreach ($files as $file) 
			{
				$attachment = new Attachment($assets . DIRECTORY_SEPARATOR . $file);
				$entry->attachments[] = $attachment;
			}
		}

		// set edit url
		$entry->edit_url = "/tfm/tinyfilemanager.php?p=markdown&edit=" . $entry->slug . ".md&env=ace";

		return $entry;
	}

	// Returns the yaml section as a string from the top of a markdown file,
	// or NULL if there is no yaml section
	public function extractYaml($s) 
	{
		$separator = '---' . MEM_EOL;
		$a = explode($separator, $s, 3);
		if (count($a) > 0 && $a[0] === '') {
			return $a[1];
		}
		return NULL;
	}

	// Returns the Markdown portion (everything after the Yaml frontmatter) of the given string
	public function extractMarkdown($s) 
	{
		$separator = '---' . MEM_EOL;
		$a = explode($separator, $s, 3);
		if (count($a) > 1 && $a[0] === '') {
			return ltrim($a[2]);
		}
		return NULL;
	}

    public function fromSlug($slug) 
    {
        return $this->slugs[$slug];
    }

}

<?php
require_once "../models/entry.php";
require_once "../models/attachment.php";

class Entries
{
    public $path;

    public function __construct(string $path)
    {
        $this->_path = $path;
        $this->load_entries();
    }

    public function load_entries() 
    {
        $entries_path = $path . DIRECTORY_SEPARATOR . 'markdown';
        $assets_path = $path . DIRECTORY_SEPARATOR . 'assets';
        $entries_dir = new DirectoryIterator(dirname(__FILE__));
        foreach ($entries_dir as $fileinfo) {
            if ($fileinfo->getExtension() == 'md') {
                $entry = new Entry();
                $entry->path = $fileinfo->getPath();
                var_dump($fileinfo->getFilename());
            }
        }
        // read in each entry
            // parse yaml
            // parse 
            // read in attachments

    }
}
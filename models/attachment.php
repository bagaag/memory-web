<?php

// Attachment represents a user-uploaded file associated with an Entry.

class Attachment
{
    public string $name = "";
    public string $extension = "";
    public string $path = "";

	public function __construct($path) {
        $pathinfo = pathinfo($path);
        $this->name = $pathinfo['filename'];
        $this->extension = $pathinfo['extension'];
        $this->path = $path;
    }

    public function url($entry) {
        $imgs = array(
            '/images/tmp/1.jpg',
            '/images/tmp/2.png',
            '/images/tmp/3.jpg',
            '/images/tmp/4.jpg',
            '/images/tmp/5.webp',
            '/images/tmp/6.jpg'
        );
        return $imgs[array_rand($imgs)];
        //return '/entry/' . $entry->slug . '/' . $this->slug . '.' . $this->ext;
    }
}

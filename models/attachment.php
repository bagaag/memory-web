<?php

class Attachment
{
    public int $index = 0;
    public string $name = "";
    public string $slug = "";
    public string $extension = "";

	public function __construct($index, $name, $slug, $extension) {
        $this->index = $index;
        $this->name = $name;
        $this->slug = $slug;
        $this->extension = $extension;
        $this->file = $file;
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

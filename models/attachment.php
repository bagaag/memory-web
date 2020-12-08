<?php

class Attachment
{
    public string $name = "";
    public string $file = "";

	public function __construct($name, $file) {
        $this->name = $name;
        $this->file = $file;
    }
}

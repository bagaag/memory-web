<?php

// Attachment represents a user-uploaded file associated with an Entry.

class Attachment
{
    public string $slug = "";
    public string $name = "";
    public string $extension = "";
    public string $path = "";
    public string $uri = "";

	public function __construct($path) {
        $pathinfo = pathinfo($path);
        $this->name = $pathinfo['filename'];
        $this->extension = $pathinfo['extension'];
        $this->path = $path;
        $this->slug = pathinfo(dirname($path))['filename'];
        $this->uri = '/entries/attachments/' . $this->slug . '/' . $this->name . '.' . $this->extension;
    }

    public function isImage() 
    {
        // TODO: implement attachment.isImage()
        return true;
    }

}

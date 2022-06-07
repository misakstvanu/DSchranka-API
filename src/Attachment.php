<?php

namespace Misakstvanu\DschrankaApi;

class Attachment {
    private string $mimetype;
    private string $filename;
    private string $content;

    public function __construct(string $mimetype, string $filename, string $content){
        $this->mimetype = $mimetype;
        $this->filename = $filename;
        $this->content = $content;
    }

    public function getMimetype(): string { return $this->mimetype; }
    public function getFilename(): string { return $this->filename; }
    public function getContent(): bool|string { return base64_decode($this->content); }
}

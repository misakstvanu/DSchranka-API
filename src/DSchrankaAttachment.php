<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaAttachment {
    private $mimetype;
    private $filename;
    private $content;

    public function __construct($data){
        $this->mimetype = $data['dmMimeType'];
        $this->filename = $data['dmFileDescr'];
        $this->content = $data['dmEncodedContent'];
    }

    public function getMimetype(){ return $this->mimetype; }
    public function getFilename(){ return $this->filename; }
    public function getContent(){ return base64_decode($this->content); }
}

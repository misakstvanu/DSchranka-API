<?php

namespace Misakstvanu\DschrankaApiLaravel;

class MessageFile {
    private $content;

    function __construct($content){
        $this->content = $content;
    }

    function getContent(){ return base64_decode($this->content); }
}

<?php

namespace App\Helpers;

class DSchrankaMessageFile {
    private $content;

    function __construct($content){
        $this->content = $content;
    }

    function getContent(){ return base64_decode($this->content); }
}

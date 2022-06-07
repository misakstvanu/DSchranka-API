<?php

namespace Misakstvanu\DschrankaApiLaravel;

class MessageFile {
    private string $content;

    function __construct($content){
        $this->content = $content;
    }

    function getContent(): bool|string{ return base64_decode($this->content); }
}

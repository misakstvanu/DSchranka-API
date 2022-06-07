<?php

namespace Misakstvanu\DschrankaApi;

class MessageFile {
    private string $content;

    function __construct($content){
        $this->content = $content;
    }

    function getContent(): bool|string{ return base64_decode($this->content); }
}

<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DeliveryInfoFile {
    private $content;

    public function __construct($content){
        $this->content = $content;
    }

    public function getContent(){ return base64_decode($this->content); }
}

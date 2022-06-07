<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaDeliveryInfoFile {
    private $content;

    public function __construct($content){
        $this->content = $content;
    }

    public function getContent(){ return base64_decode($this->content); }
}

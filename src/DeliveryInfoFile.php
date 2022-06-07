<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DeliveryInfoFile {
    private string $content;

    public function __construct($content){
        $this->content = $content;
    }

    public function getContent(): bool|string{ return base64_decode($this->content); }
}

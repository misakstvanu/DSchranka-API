<?php

namespace Misakstvanu\DschrankaApi;

class DeliveryInfoFile {
    private string $content;

    public function __construct(string $content){
        $this->content = $content;
    }

    public function getContent(): bool|string{ return base64_decode($this->content); }
}

<?php

namespace Misakstvanu\DschrankaApiLaravel;

class MessageRecipient {
    private string $name;
    private string $address;

    public function __construct($name, $address){
        $this->name = $name;
        $this->address = $address;
    }

    public function getName(): string{ return $this->name; }
    public function getAddress(): string{ return $this->address; }
}

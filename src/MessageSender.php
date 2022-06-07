<?php

namespace Misakstvanu\DschrankaApi;

class MessageSender {
    private string $name;
    private string $address;
    private int $type;

    public function __construct($name, $address, $type){
        $this->name = $name;
        $this->address = $address;
        $this->type = $type;
    }

    public function getName(): string{ return $this->name; }
    public function getAddress(): string{ return $this->address; }
    public function getType(): DataboxType{ return new DataboxType($this->type); }
    public function getTypeShort(): string{ return (new DataboxType($this->type))->short(); }
    public function getTypeLong(): string{ return (new DataboxType($this->type))->long(); }
}

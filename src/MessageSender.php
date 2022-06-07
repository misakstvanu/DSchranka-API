<?php

namespace Misakstvanu\DschrankaApiLaravel;

class MessageSender {
    private $name;
    private $address;
    private $type;

    public function __construct($name, $address, $type){
        $this->name = $name;
        $this->address = $address;
        $this->type = $type;
    }

    public function getName(){ return $this->name; }
    public function getAddress(){ return $this->address; }
    public function getType(){ return new DataboxType($this->type); }
    public function getTypeShort(){ return (new DataboxType($this->type))->short(); }
    public function getTypeLong(){ return (new DataboxType($this->type))->long(); }
}

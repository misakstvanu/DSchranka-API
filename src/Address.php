<?php

namespace Misakstvanu\DschrankaApi;

class Address {
    private string $name;
    private string $type;
    private string $id;

    public function __construct($name, $type, $id){
        $this->name = $name;
        $this->type = $type;
        $this->id = $id;
    }

    public function toArray(): array{
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getType()
        ];
    }


    public function getName(): string{ return $this->name; }
    public function getType(): string{ return $this->type; }
    public function getId(): string{ return $this->id; }
}

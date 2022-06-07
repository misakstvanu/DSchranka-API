<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaAddress {
    const FIELDS = ['name', 'type', 'id'];
    private $name;
    private $type;
    private $id;

    public function __construct($data){
        foreach(self::FIELDS as $field)
            $this->$field = $data[$field];
    }

    public function toArray(){
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getType()
        ];
    }


    public function getName(){ return $this->name; }
    public function getType(){ return $this->type; }
    public function getId(){ return $this->id; }
}

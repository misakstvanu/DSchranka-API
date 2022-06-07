<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaDataboxType {
    const TYPES = [0 => 'SYS', 10 => 'OVM', 20 => 'PO', 30 => 'PFO', 40 => 'FO'];
    const TYPES_LONG = [0 => 'Systém', 10 => 'Orgán veřejné moci', 20 => 'Právnická osoba', 30 => 'Podnikající fyzická osoba', 40 => 'Fyzická osoba'];
    private $typeId;

    public function __construct($typeId){
        $this->typeId = $typeId;
    }

    public function short(){ return self::TYPES[(int)$this->typeId]; }
    public function long(){ return self::TYPES_LONG[(int)$this->typeId]; }
}

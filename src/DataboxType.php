<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DataboxType {
    const TYPES = [0 => 'SYS', 10 => 'OVM', 20 => 'PO', 30 => 'PFO', 40 => 'FO'];
    const TYPES_LONG = [0 => 'Systém', 10 => 'Orgán veřejné moci', 20 => 'Právnická osoba', 30 => 'Podnikající fyzická osoba', 40 => 'Fyzická osoba'];
    private int $typeId;

    public function __construct(int $typeId){
        $this->typeId = $typeId;
    }

    public function short(): string{ return self::TYPES[$this->typeId]; }
    public function long(): string{ return self::TYPES_LONG[$this->typeId]; }
}

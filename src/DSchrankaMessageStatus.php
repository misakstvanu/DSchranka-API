<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaMessageStatus {
    const STATUSES = [
        0 => 'nedostupné',
        1 => 'podáno',
        2 => 'podepsáno',
        3 => 'AV',
        4 => 'dodáno',
        5 => '10 dní',
        6 => 'doručeno',
        7 => 'přečteno',
        8 => 'nedoručeno',
        9 => 'smazáno',
        10 => 'trezor',
    ];
    const STATUSES_LONG = [
        0 => 'K této zprávě neexistuje platná doručenka.',
        1 => 'Datová zpráva byla podána (vznikla v ISDS).',
        2 => 'Datová zpráva včetně písemností podepsána podacím časovým razítkem.',
        3 => 'Datová zpráva neprošla antivirovou kontrolou – zpráva není dodána. Toto je konečný stav zprávy před smazáním.',
        4 => 'Datová zpráva je dodána do schránky adresáta a je přístupná adresátovi.',
        5 => 'Uplynulo 10 dní od dodání zprávy orgánu veřejné správy, která dosud nebyla doručena přihlášením (předpoklad doručení fikcí u neOVM schránky).',
        6 => 'Osoba oprávněná číst tuto zprávu se přihlásila – zpráva byla doručena přihlášením.',
        7 => 'Zpráva byla přečtena (stažena) příjemcem.',
        8 => 'Zpráva byla označena jako nedoručitelná, protože schránka adresáta byla znepřístupněna.',
        9 => 'Obsah zprávy byl smazán, obálka zprávy včetně hashů přesunuta do archivu.',
        10 => 'Zpráva byla přesunuta do Datového trezoru odesílatele nebo adresáta (nebo obou).',
    ];
    private $statusId;

    public function __construct($statusId){
        $this->statusId = $statusId;
    }

    public function short(){ return self::STATUSES[(int)$this->statusId]; }
    public function long(){ return self::STATUSES_LONG[(int)$this->statusId]; }
}

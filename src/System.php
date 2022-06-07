<?php

namespace Misakstvanu\DschrankaApiLaravel;

class System {

    static function ping(): bool{
        HTTPClient::request('GET', '/ping');
        return true;
    }

}

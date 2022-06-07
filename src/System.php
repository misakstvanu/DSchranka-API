<?php

namespace Misakstvanu\DschrankaApi;

class System {

    static function ping(): bool{
        HTTPClient::request('GET', '/ping');
        return true;
    }

}

<?php

namespace Misakstvanu\DschrankaApiLaravel;

class System {

    static function ping(){
        HTTPClient::request('GET', '/ping');
        return true;
    }

}

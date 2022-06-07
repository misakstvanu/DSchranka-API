<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaSystem {

    static function ping(){
        DSchrankaHTTPClient::request('GET', '/ping');
        return true;
    }

}

<?php

namespace App\Helpers;

class DSchrankaSystem {

    static function ping(){
        DSchrankaHTTPClient::request('GET', '/ping');
        return true;
    }

}

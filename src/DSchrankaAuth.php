<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaAuth {

    /**
     * @return bool
     */
    public function check(){
        DSchrankaHTTPClient::request('GET', '/auth');
        return true;
    }

    /**
     * @return bool
     */
    public function invalidate(){
        DSchrankaHTTPClient::request('DELETE', '/auth');
        return true;
    }
}

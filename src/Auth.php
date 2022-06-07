<?php

namespace Misakstvanu\DschrankaApiLaravel;

class Auth {

    /**
     * @return bool
     */
    public function check(){
        HTTPClient::request('GET', '/auth');
        return true;
    }

    /**
     * @return bool
     */
    public function invalidate(){
        HTTPClient::request('DELETE', '/auth');
        return true;
    }
}

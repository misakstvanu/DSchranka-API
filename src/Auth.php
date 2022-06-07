<?php

namespace Misakstvanu\DschrankaApiLaravel;

class Auth {

    public function check(): bool{
        HTTPClient::request('GET', '/auth');
        return true;
    }

    public function invalidate(): bool{
        HTTPClient::request('DELETE', '/auth');
        return true;
    }
}

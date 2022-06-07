<?php

namespace Misakstvanu\DschrankaApiLaravel;

use GuzzleHttp\Psr7\Response;

class HTTPResponse {
    private Response $response;

    public function __construct($response){
        $this->response = $response;
    }

    public function raw(){
        return $this->response;
    }

    public function json(){
        return json_decode($this->response->getBody(), true);
    }

    public function code(){
        return $this->response->getStatusCode();
    }

}

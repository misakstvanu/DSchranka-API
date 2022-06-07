<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class DSchrankaHTTPClient {
    const URL = 'https://dschranka.cz/api/partner';
    const LOCAL_URL = 'http://127.0.0.1:8001/api/partner';

    static function request($method, $uri, $data = null){
        //todo throw api key not set
        $method = strtoupper($method);
        $client = new Client();

        $response = $client->request(
            $method,
            self::LOCAL_URL.$uri,
            options: [
                'headers' => [
                    'Authorization' => 'Bearer '.'SjNUsdQa0yipPSWVFSL9L9DzdL3xErQPZsVNyQHrxJKzcnPbp7BzFsxopjnqkyDq'
                ],
                'form_params' => ($method == 'POST' || $method == 'PUT') ? $data : null,
                'query' => $method == 'GET' ? $data : null
            ]
        );

        return new DSchrankaHTTPResponse($response);
    }


}

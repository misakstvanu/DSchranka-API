<?php

namespace Misakstvanu\DschrankaApi;

use GuzzleHttp\Client;

class HTTPClient {
    const URL = 'https://dschranka.cz/api/partner';
    const LOCAL_URL = 'http://127.0.0.1:8001/api/partner';

    static function request($method, $uri, $data = null): HTTPResponse{
        //todo throw api key not set
        $method = strtoupper($method);
        $client = new Client();

        $response = $client->request(
            $method,
            config('dschranka.local') ? self::LOCAL_URL.$uri : self::URL.$uri,
            options: [
                'headers' => [
                    'Authorization' => 'Bearer '.config('dschranka.apiKey')
                ],
                'form_params' => ($method == 'POST' || $method == 'PUT') ? $data : null,
                'query' => $method == 'GET' ? $data : null
            ]
        );

        return new HTTPResponse($response);
    }


}

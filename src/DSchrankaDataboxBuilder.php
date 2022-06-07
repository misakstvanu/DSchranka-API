<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaDataboxBuilder {

    /**
     * @return array<DSchrankaDatabox>
     */
    public function list($restorable = false){
        $response = DSchrankaHTTPClient::request('GET', '/databox', ['restorable' => $restorable]);
        $list = [];
        foreach($response->json() as $item){
            array_push($list, DSchrankaDatabox::fromArray($item));
        }
        return $list;
    }

    public function create($username, $password){
        $response = DSchrankaHTTPClient::request('POST', '/databox', [
            'username' => $username,
            'password' => $password
        ]);
        return DSchrankaDatabox::fromArray($response->json());
    }

}

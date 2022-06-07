<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DataboxBuilder {

    /**
     * @return array<Databox>
     */
    public function list($restorable = false){
        $response = HTTPClient::request('GET', '/databox', ['restorable' => $restorable]);
        $list = [];
        foreach($response->json() as $item){
            array_push($list, Databox::fromArray($item));
        }
        return $list;
    }

    public function create($username, $password){
        $response = HTTPClient::request('POST', '/databox', [
            'username' => $username,
            'password' => $password
        ]);
        return Databox::fromArray($response->json());
    }

}

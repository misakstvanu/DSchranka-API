<?php

namespace Misakstvanu\DschrankaApi;

class DataboxBuilder {

    /**
     * @return array<Databox>
     */
    public function list($restorable = false): array{
        $response = HTTPClient::request('GET', '/databox', ['restorable' => $restorable]);
        $list = [];
        foreach($response->json() as $item){
            $list[] = Databox::fromArray($item);
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

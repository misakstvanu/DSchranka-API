<?php

namespace Misakstvanu\DschrankaApi;

class DSchrankaClient {
    private string $apiKey;
    
    public function __construct(string $apiKey){
        $this->apiKey = $apiKey;
    }

    public static function ping(): bool{
        return System::ping();
    }

    public static function auth(): Auth{
        return new Auth();
    }

    public static function databox(int $databox_id = null): Databox|DataboxBuilder{
        if($databox_id)
            return new Databox($databox_id);
        else
            return new DataboxBuilder();
    }




}

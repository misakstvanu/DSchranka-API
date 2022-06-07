<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaAPI {

    public static function ping(){
        return DSchrankaSystem::ping();
    }

    public static function auth(){
        return new DSchrankaAuth();
    }

    public static function databox($databox_id = null){
        if($databox_id)
            return new DSchrankaDatabox($databox_id);
        else
            return new DSchrankaDataboxBuilder();
    }




}

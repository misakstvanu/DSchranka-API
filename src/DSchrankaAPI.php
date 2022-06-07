<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaAPI {

    public static function ping(){
        return System::ping();
    }

    public static function auth(){
        return new Auth();
    }

    public static function databox($databox_id = null){
        if($databox_id)
            return new Databox($databox_id);
        else
            return new DataboxBuilder();
    }




}

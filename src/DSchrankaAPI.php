<?php

namespace Misakstvanu\DschrankaApi;

class DSchrankaAPI {

    public static function ping(): bool{
        return System::ping();
    }

    public static function auth(): Auth{
        return new Auth();
    }

    public static function databox($databox_id = null): Databox|DataboxBuilder{
        if($databox_id)
            return new Databox($databox_id);
        else
            return new DataboxBuilder();
    }




}

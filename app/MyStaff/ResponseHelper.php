<?php

namespace App\MyStaff;

class ResponseHelper {

    /**
     * Encode data to a json string
     */
    public static function json(mixed $data, int $flags = JSON_PRETTY_PRINT) : string
    {
        return json_encode($data, $flags);
    }

}
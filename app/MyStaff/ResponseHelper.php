<?php

namespace App\MyStaff;

class ResponseHelper {

    /**
     * Encode data to a json string
     */
    public static function json(mixed $data, int $status = 200, array $headers = [], int $flags = JSON_PRETTY_PRINT)
    {
        return response()->json($data, $status, $headers, $flags);
    }

}
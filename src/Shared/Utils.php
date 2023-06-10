<?php

namespace App\Shared;

class Utils
{
    public static function validateUuid(string $uuid): bool
    {
        return preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $uuid) === 1;
    }

}
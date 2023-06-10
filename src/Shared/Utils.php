<?php

namespace App\Shared;

use Ramsey\Uuid\Uuid;

class Utils
{
    public static function validateUuid(string $uuid): bool
    {
        return Uuid::isValid($uuid);
    }

    public static function validatePassword(string $password): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).{8,}$/', $password);
    }

    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
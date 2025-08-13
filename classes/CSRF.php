<?php

class CSRF
{
    public function generate()
    {
        $token = $_SESSION['csrf_token'] ?? null;

        if (!$token) {
            return $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $token;
    }

    public function validate($token)
    {
        $sessionToken = $_SESSION['csrf_token'] ?? null;

        if (!$sessionToken) {
            return false;
        }

        unset($_SESSION['csrf_token']);

        return is_string($sessionToken) && is_string($token) && hash_equals($sessionToken, $token);
    }
}
<?php

namespace App\Models;

use App\Services\Database;

class User
{
    public static function getById($id)
    {
        try {
            $stmt = Database::prepare("SELECT * FROM `users` WHERE `id` = :id AND status = 1 LIMIT 1");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch() ?? null;
        } catch (Throwable $e) {
            error_log('Erro em Auth@getById: ' . $e->getMessage());
            return null;
        }
    }

    public static function getByUsername($username)
    {
        try {
            $stmt = Database::prepare("SELECT * FROM `users` WHERE `username` = :username AND status = 1 LIMIT 1");
            $stmt->execute(['username' => $username]);
            return $stmt->fetch() ?? null;
        } catch (Throwable $e) {
            error_log('Erro em Auth@getByUsername: ' . $e->getMessage());
            return null;
        }
    }
}
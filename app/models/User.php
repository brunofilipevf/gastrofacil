<?php

namespace App\Models;

use App\Services\Database;

class User
{
    public static function all()
    {
        try {
            $stmt = Database::prepare("SELECT * FROM `users`");
            $stmt->execute();
            $users = $stmt->fetchAll() ?? [];

            foreach ($users as &$user) {
                unset($user['password']);
            }

            return $users;
        } catch (Throwable $e) {
            error_log('Erro em Auth@all: ' . $e->getMessage());
            return null;
        }
    }

    public static function getById($id)
    {
        try {
            $stmt = Database::prepare("SELECT * FROM `users` WHERE `id` = :id AND status = 1 LIMIT 1");
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch() ?? null;

            if ($user) {
                unset($user['password']);
            }

            return $user;
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
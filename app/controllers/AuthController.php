<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        if (!csrf()->validate($_POST['csrf_token'])) {
            flash()->danger('Formulário inválido ou expirado.');
            return false;
        }

        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];

        validate()->name('nome de usuário')->value($data['username'])->required()->string();
        validate()->name('senha')->value($data['password'])->required()->string();

        $user = User::getByUsername($data['username']);
        if (!$user || !password_verify($data['password'], $user['password'])) {
            flash()->danger('Credenciais inválidas ou usuário inativo.');
            return false;
        }

        session_regenerate_id(true);

        $_SESSION['auth']['id'] = $user['id'];
        $_SESSION['auth']['last_access'] = time();

        return true;
    }

    public function logout()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public function isLogged()
    {
        $userId = $_SESSION['auth']['id'] ?? null;
        if (!$userId) {
            return false;
        }

        $lastAccess = $_SESSION['auth']['last_access'] ?? null;
        if (!$lastAccess || (time() - $lastAccess) > 900) {
            $this->logout();
            return false;
        }

        $user = User::getById($userId);
        if (!$user) {
            $this->logout();
            return false;
        }

        $_SESSION['auth']['last_access'] = time();
        return true;
    }

    public function requiredLevel($minLevel)
    {
        $userId = $_SESSION['auth']['id'] ?? null;
        if (!$userId) {
            return false;
        }

        $user = User::getById($userId);
        if (!$user || $user['level'] < $minLevel) {
            return false;
        }

        return true;
    }
}
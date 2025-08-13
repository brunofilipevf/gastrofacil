<?php

namespace App\Services;

class Flash
{
    public function success($message)
    {
        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        $_SESSION['flash']['type'] = 'success';
        $_SESSION['flash']['message'] = $message;
    }

    public function danger($message)
    {
        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        $_SESSION['flash']['type'] = 'danger';
        $_SESSION['flash']['message'] = $message;
    }

    public function obtain()
    {
        $type = $_SESSION['flash']['type'] ?? null;
        $message = $_SESSION['flash']['message'] ?? null;

        unset($_SESSION['flash']);

        if (!$type || !$message) {
            return null;
        }

        return ['type' => $type, 'message' => $message];
    }
}
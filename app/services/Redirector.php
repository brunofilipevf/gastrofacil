<?php

namespace App\Services;

class Redirector
{
    public function to($path)
    {
        header('Location: ' . $path);
        exit();
    }

    public function back()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $refererHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            $currentHost = $_SERVER['HTTP_HOST'];

            if ($refererHost === $currentHost) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }

        header('Location: /');
        exit();
    }
}
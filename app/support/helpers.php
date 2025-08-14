<?php

function auth()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new App\Controllers\AuthController();
    }

    return $instance;
}

function csrf()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new App\Services\CSRF();
    }

    return $instance;
}

function flash()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new App\Services\Flash();
    }

    return $instance;
}

function redirect()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new App\Services\Redirector();
    }

    return $instance;
}

function validate()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new App\Services\Validator();
    }

    return $instance;
}
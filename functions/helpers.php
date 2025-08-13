<?php

function auth()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new Auth();
    }

    return $instance;
}

function csrf()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new CSRF();
    }

    return $instance;
}

function flash()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new Flash();
    }

    return $instance;
}

function validate()
{
    static $instance = null;

    if ($instance === null) {
        $instance = new Validator();
    }

    return $instance;
}
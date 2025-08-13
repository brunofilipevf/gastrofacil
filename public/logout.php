<?php

// --- Inicializar arquivo do composer
require_once __DIR__ . '/../vendor/autoload.php';

// --- Inicializar arquivo de bootstrap
require_once __DIR__ . '/../bootstrap.php';

// --- Realizar logout
auth()->logout();

// --- Redirecionar
redirect()->to('login.php');
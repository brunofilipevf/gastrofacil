<?php

// --- Inicializar arquivo do composer
require_once __DIR__ . '/../vendor/autoload.php';

// --- Inicializar arquivo de bootstrap
require_once __DIR__ . '/../bootstrap.php';

// --- Verificar autenticação
if (auth()->isLogged()) {
    redirect()->to('index.php');
}

// --- Template
$pageTitle = 'Entrar';
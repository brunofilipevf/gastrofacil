<?php

// --- Configuração de fuso horário

define('TIMEZONE', 'America/Recife');

// --- Configurações da aplicação

define('APP_URL', 'http://gastrofacil.test');
define('APP_NAME', 'Gastro Fácil');
define('APP_DESC', 'Sistema de Gastrobar');
define('APP_DEBUG', true);

// --- Configurações do banco de dados

define('DB_HOST', 'localhost');
define('DB_NAME', 'gastrofacil');
define('DB_CHAR', 'utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', '');

// --- Configuração de nível de acesso

define('LEVELS', [
    1 => 'Atendente',
    2 => 'Operador',
    3 => 'Gerente',
    4 => 'Diretor',
    5 => 'Administrador'
]);
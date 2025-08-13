<?php

// --- Definição de fuso horário

date_default_timezone_set(TIMEZONE);

// --- Definições de depuração

if (APP_DEBUG) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    ini_set('error_log', __DIR__ . '/cache/php_errors_dev.log');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('error_log', __DIR__ . '/cache/php_errors_' . date('Y-m-d') . '.log');
    error_reporting(0);
}

// --- Definições de sessão

ini_set('session.save_path', __DIR__ . '/cache');
ini_set('session.gc_maxlifetime', 1440);
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.lazy_write', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.sid_length', 48);
ini_set('session.sid_bits_per_character', 6);

// --- Definições gerais do php

ini_set('expose_php', 'Off');
ini_set('file_uploads', 'Off');
ini_set('allow_url_fopen', 'Off');
ini_set('allow_url_include', 'Off');
ini_set('post_max_size', '1M');
ini_set('memory_limit', '128M');
ini_set('max_execution_time', 30);
ini_set('disable_functions', 'exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source');

// --- Definições de cabeçalhos

$csp = "default-src 'self'; ";
$csp .= "script-src 'self' https://cdnjs.cloudflare.com; ";
$csp .= "style-src 'self' https://cdnjs.cloudflare.com; ";
$csp .= "font-src 'self' https://cdnjs.cloudflare.com; ";
$csp .= "img-src 'self' data:; ";
$csp .= "object-src 'none'; ";
$csp .= "frame-ancestors 'none'; ";
$csp .= "form-action 'self'; ";
$csp .= "upgrade-insecure-requests;";

header('Content-Security-Policy: ' . $csp);
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header('X-XSS-Protection: 1; mode=block');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
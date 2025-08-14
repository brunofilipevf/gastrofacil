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

?>

<h1><?php echo e($pageTitle); ?></h1>

<?php if ($flash = flash()->obtain()) : ?>
    <p><?php echo e($flash['message']); ?></p>
<?php endif; ?>

<p>Página de login.</p>
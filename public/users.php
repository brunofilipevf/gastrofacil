<?php

// --- Inicializar arquivo do composer
require_once __DIR__ . '/../vendor/autoload.php';

// --- Inicializar arquivo de bootstrap
require_once __DIR__ . '/../bootstrap.php';

// --- Verificar autenticação
if (!auth()->isLogged()) {
    redirect()->to('login.php');
}

// --- Verificar nível de acesso
if (!auth()->requiredLevel(2)) {
    redirect()->to('403.php');
}

// --- Template
$pageTitle = 'Usuários';

?>

<h1><?php echo e($pageTitle); ?></h1>

<?php if ($flash = flash()->obtain()) : ?>
    <p><?php echo e($flash['message']); ?></p>
<?php endif; ?>

<p><?php echo '<pre>' . print_r(user()->index(), true) . '</pre>'; ?></p>
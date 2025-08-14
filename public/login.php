<?php

// --- Inicializar arquivo do composer
require_once __DIR__ . '/../vendor/autoload.php';

// --- Inicializar arquivo de bootstrap
require_once __DIR__ . '/../bootstrap.php';

// --- Verificar autenticação
if (auth()->isLogged()) {
    redirect()->to('index.php');
}

// --- Submeter formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (auth()->login()) {
        redirect()->to('index.php');
    } else {
        redirect()->back();
    }
}

// --- Template
$pageTitle = 'Entrar';

?>

<h1><?php echo e($pageTitle); ?></h1>

<?php if ($flash = flash()->obtain()) : ?>
    <p><?php echo e($flash['message']); ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?php echo csrf()->generate(); ?>">
    <p><input type="text" name="username" placeholder="nome de usuário"></p>
    <p><input type="password" name="password" placeholder="senha"></p>
    <p><button type="submit">Entrar</button></p>
</form>
<?php
$title = 'nouveau compte';

$errors = getErrorUser($_POST);

if (empty($errors)) {
    $pdo = getPDO();
    if (!empty($_POST)) {
        createUser($pdo, $_POST);
        redirect(generate("user.confirm", ['utilisateur' => $_POST['utilisateur']]));
    }
}
?>

<div class="container <?= !empty($errors) ? 'is-error' : '' ?>">
        <h2>nouveau</h2>
        <form action="" class="form is-error" method="post">
            <div class="form-group">
                <?= inputField('nom', [
                    'type' => 'text',
                    'class' => 'field',
                    'placeholder' => 'votre nom'
                ], $_POST, $errors) ?>
            
            </div>
            <div class="form-group">
            <div class="form-group">
                <?= inputField('prenom', [
                    'type' => 'text',
                    'class' => 'field',
                    'placeholder' => 'votre prénom'
                ], $_POST, $errors) ?>
            </div>
            <div class="form-group">
                <div class="form-group">
                <?= inputField('utilisateur', [
                    'type' => 'text',
                    'class' => 'field',
                    'placeholder' => "nom d'utilisateur"
                ], $_POST, $errors) ?>
            </div>
            <div class="form-group">
                 <?= inputField('email', [
                    'type' => 'email',
                    'class' => 'field',
                    'placeholder' => "email"
                ], $_POST, $errors) ?>
            </div>
            <div class="form-group">
                <?= inputField('password', [
                    'type' => 'password',
                    'class' => 'field',
                    'placeholder' => "mot de passe"
                ], $_POST, $errors) ?>
            </div>
            <button>créer</button>
        </form>
        <div class="options">
            <a href="<?= generate('user') ?>">j'ai déjà un compte </a>
        </div>
    </div>

<?php
$title = 'confirmation du code de réinitialisation';

$pdo = getPDO();

$token = getQueryParamsString('token');
if (is_null($token)) {
    throw new Exception("l'utilisateur #$token n'existe pas");
}

$user = getUser($pdo, 'token', $token);

if (empty($user)) {
    throw new Exception("l'utilisateur #$token n'existe pas");
}

$errors = getErrorUserPass($_POST);

if (empty($errors) && !empty($_POST)) {
    if (changePasswordUser($pdo, $_POST, $user['utilisateur_id'])) {
        $message = "votre mot de passe a été mis à jour";
        setFlash('success', $message , generate('user'));
        redirect(generate('user'));
    }
}

?>
<div class="container <?= !empty($errors) ? 'is-error' : '' ?>">
        <h2>Mot de passe</h2>
        <form action="" class="form" method="post">
            <div class="form-group">
                <?= inputField('password', [
                    'type' => 'password',
                    'class' => 'field',
                    'placeholder' => "nouveau mot de passe"
                ], $_POST, $errors) ?>
            </div>
            <div class="form-group">
                <?= inputField('confirm', [
                    'type' => 'password',
                    'class' => 'field',
                    'placeholder' => "confirmation"
                ], $_POST, $errors) ?>
            </div>
            <button type="submit"> <i class="fa fa-user-edit"></i> Modifier</button>

        </form>
    </div>

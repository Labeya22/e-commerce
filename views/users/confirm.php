<?php
isConnected();

$title = 'confirmation du compte';

$username = getQueryParamsString('utilisateur');
if (is_null($username) || empty($username)) {
    throw new Exception("une erreur est survenue, merci de réessayer plus tard.");
}

$user = getUser($pdo, 'utilisateur', $username);
if (empty($user)) {
    throw new Exception("L'utilisateur '$username' n'existe pas");
}

if (is_null($user['code'])) redirect(generate('user'));


$errors = getErrorUserConfirm($_POST);

if (empty($errors)) {
    $pdo = getPDO();
    if (!empty($_POST)) {
        if (confirmUser($pdo, $user['utilisateur_id'])) {
            $message = sprintf("%s votre compte a été créé avec succès, connectez-vous pour y acceder.", $user['utilisateur']);
            setFlash('success', $message, generate('user'));
            redirect(generate("user"));
        }
    }
}

?>

<div class="container <?= !empty($errors) ? 'is-error' : '' ?>">
        <h2>Confirmation</h2>
        <p class="desc">
            nous avons envoyé un code de confirmation à l'adresse '<strong><?= $user['email'] ?></strong>'
        </p>
        <form action="" class="form is-error" method="post">
            <div class="form-group">
                <?= inputField('code', [
                    'type' => 'text',
                    'class' => 'field',
                    'placeholder' => 'votre code de confirmation'
                ], $_POST, $errors) ?>
            </div>
            <button>confirmation</button>
        </form>
    </div>

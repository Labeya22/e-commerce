<?php
isConnected();

$title = 'confirmation du code de réinitialisation';

$pdo = getPDO();


$userid = getSession(SESSION_FORGOT);

if (is_null($userid)) redirect(generate('user.your-mail'));

$user = getUser($pdo, 'utilisateur_id', $userid);

if (empty($user)) {
    throw new Exception("nous avons pas trouvé l'utilisateur #$userid");
}

$errors = getErrorUserConfirm($_POST);

if (empty($errors) && !empty($_POST)) {
    $token = generateToken(100);

    $ok = userCodeResetOk($pdo, $user['utilisateur_id'], $token);
    if ($ok) {
        deleteSession(SESSION_FORGOT);
        redirect(generate('user.forgot', ['token' => $token]));
    }
}


?>
<div class="container <?= !empty($errors) ? 'is-error' : '' ?>">
        <h2>Code</h2>
        <p class="desc">un code de réinitialisation a été envoyer à l'adresse <strong><?= $user['email'] ?></strong></p>
        <form action="" class="form" method="post">
            <div class="form-group">
                <?= inputField('code', [
                    'type' => 'text',
                    'class' => 'field',
                    'placeholder' => "code de confirmation"
                ], $_POST, $errors) ?>
            </div>
            <button type="submit">vérifier</button>

        </form>

        <div class="options">
            <a href="<?= generate('user.your-email') ?>"> je n'ai pas reçu le code</a>
        </div>
    </div>

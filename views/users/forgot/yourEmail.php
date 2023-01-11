<?php
$title = 'mot de passe oublié';


$errors = getErrorUserYourEmail($_POST);

$pdo = getPDO();

if (empty($errors) && !empty($_POST)) {
    $email = $_POST['email'];
    [$your, $user] = userYourMail($pdo, $_POST['email']);
    if (is_null($your)) {
        throw new Exception("Une erreur est survenue, merci de recommencer");
    }
    
    $send = sendMail(
        $email,
        "code de réinitialisation du mot de passe",
        sprintf("votre code est : %s", $your)
    );

    if ($send) {
        setSession(SESSION_FORGOT, $user['utilisateur_id']);
        redirect(generate('user.code'));
    }

    // falsh erreur
}


?>
<div class="container <?= !empty($errors) ? 'is-error' : '' ?>">
        <h2>Mon compte ?</h2>
        <form action="" class="form" method="post">
            <div class="form-group">
                <?= inputField('email', [
                    'type' => 'email',
                    'class' => 'field',
                    'placeholder' => "email"
                ], $_POST, $errors) ?>
            </div>
            <button type="submit">retrouver mon compte</button>
        </form>
    </div>

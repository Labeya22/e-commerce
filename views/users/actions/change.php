<?php

checkUser(generate('user'));

$title = "stores";
$pdo = getPDO();

$userid = getQueryParamsString('userid');
if (is_null($userid) || empty($userid)) {
    throw new Exception("Une erreur erreur est survenue");
}

$user = getSession(SESSION_USER);
if ($userid != $user['utilisateur_id']) {
    deleteSession(SESSION_USER);
    throw new Exception("nous avons pas trouvé cet utilisateur.");
}

$errors = getErrorUserPass($_POST);
if (empty($errors) && !empty($_POST)) {
    if (changePasswordUser($pdo, $_POST, $user['utilisateur_id'])) {
        $userEdit = getUser($pdo, 'utilisateur_id', $user['utilisateur_id']);
        setSession(SESSION_USER, $userEdit);
        redirect(generate('user.profil'));
    }
}

?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Change le mot de passe</h2>
            </div>

            <div class="myprofil shadow-none mb-4">
               <form action="" class="form" method="POST">
                    <div class="group-form">
                        <label for="nom">mot de passe</label>
                        <?= inputField('password', [
                        'type' => 'password',
                        'class' => 'input-form',
                        'placeholder' => ""
                    ], $_POST, $errors) ?>
                    </div>
                    <div class="group-form">
                        <label for="prenom">confirmation du mot de passe</label>
                        <?= inputField('confirm', [
                        'type' => 'password',
                        'class' => 'input-form',
                        'placeholder' => ""
                    ], $_POST, $errors) ?>
                    </div>
                    <button class="button button-primary"><i class="fa fa-user-edit"></i> changer</button>
               </form>
            </div>
        </div>
    </div>
     <!-- profil  -->

    <a href="#" class="scrolltop" id="scrolltop"><i class="fa fa-circle-chevron-up"></i></a>
    <div class="container">
        <footer class="footer">
            <p>&copy; vente-car, Tous droits réservés</p>
        </footer>
    </div>
    
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

$errors = getErrorUserEdit($_POST, $user['utilisateur_id']);
if (empty($errors) && !empty($_POST)) {
    if (editUser($pdo, $_POST, $user['utilisateur_id'])) {
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
                <h2>Editer son compte</h2>
            </div>

            <div class="myprofil shadow-none mb-4">
               <form action="" class="form" method="POST">
                    <div class="group-form">
                        <label for="nom">nom</label>
                        <?= inputField('nom', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'value' => 'app',
                        'placeholder' => "nom"
                    ], $_POST, $errors, $user['nom']) ?>
                    </div>
                    <div class="group-form">
                        <label for="prenom">prénom</label>
                        <?= inputField('prenom', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'value' => 'app',
                        'placeholder' => "prenom"
                    ], $_POST, $errors, $user['prenom']) ?>
                    </div>
                    <div class="group-form">
                        <label for="utilisateur">nom d'utilisateur</label>
                        <?= inputField('utilisateur', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'value' => 'app',
                        'placeholder' => "nom d'utilisateur"
                    ], $_POST, $errors, $user['utilisateur']) ?>
                    </div>
                    <div class="group-form">
                        <label for="email">Email</label>
                        <?= inputField('email', [
                        'type' => 'email',
                        'class' => 'input-form',
                        'value' => 'app',
                        'placeholder' => "email"
                    ], $_POST, $errors, $user['email']) ?>
                    </div>
                    <button class="button button-primary"><i class="fa fa-user-edit"></i> editer</button>
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
    
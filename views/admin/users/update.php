<?php


$title = "editer l'utilisateur";

$userid = getQueryParamsString('userid');
if (empty($userid) || is_null($userid)) {
    throw new Exception("");
}

$user = getUser('utilisateur_id', $userid);

if (empty($user)) {
    throw new Exception("");
}

$errors = getErrorUserEdit($_POST, $userid);

if (empty($errors) && !empty($_POST)) {
    $redirect = generate('admin.users');
    $name = $_POST['nom'];
    $create = editUser($_POST, $userid);
    if ($create) {
        setFlash('success', "information mis à jour.", $redirect);
    } else {
        setFlash('danger', "une erreur est survnue.", $redirect);
    }

    redirect($redirect);
}


?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Editer  l'utilisateur</h2>
            </div>
            <form action="" class="form w-80" method="POST">
                <div class="group-form-grid">
                    <div class="group-form">
                        <label for="nom">nom</label>
                        <?= inputField('nom', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "nom"
                    ], $_POST, $errors, $user['nom']) ?>
                    </div>
                    <div class="group-form">
                        <label for="prenom">prénom</label>
                        <?= inputField('prenom', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "prenom"
                    ], $_POST, $errors, $user['prenom']) ?>
                    </div>
                </div>
                <div class="group-form-grid">
                    <div class="group-form">
                        <label for="utilisateur">nom d'utilisateur</label>
                        <?= inputField('utilisateur', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "nom d'utilisateur"
                    ], $_POST, $errors, $user['utilisateur']) ?>
                    </div>
                    <div class="group-form">
                        <label for="email">Email</label>
                        <?= inputField('email', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "Email"
                    ], $_POST, $errors, $user['email']) ?>
                    </div>
                </div>
                <button class="button button-primary"><i class="fa fa-edit"></i> Editer</button>
            </form>
        </div>
    </div>
     <!-- profil  -->

    <a href="#" class="scrolltop" id="scrolltop"><i class="fa fa-circle-chevron-up"></i></a>
    <div class="container">
        <footer class="footer">
            <p>&copy; vente-car, Tous droits réservés</p>
        </footer>
    </div>
    
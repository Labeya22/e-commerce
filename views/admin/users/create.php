<?php


$title = "ajout d'une marque";

$errors = getErrorUser($_POST);

if (empty($errors) && !empty($_POST)) {
    $redirect = generate('admin.users');
    $name = $_POST['marque'];
    $create = createUserOk($_POST);
    if ($create) {
        setFlash('success', "l'utilisateur $name a été ajouté.", $redirect);
    } else {
        setFlash('danger', "l'utilisateur $name n'a  pas pu être ajouté.", $redirect);
    }

    redirect($redirect);
}


?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>ajouter un utilisateur</h2>
            </div>
            <form action="" class="form w-80" method="POST">
                <div class="group-form-grid">
                    <div class="group-form">
                        <label for="nom">nom</label>
                        <?= inputField('nom', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "nom"
                    ], $_POST, $errors) ?>
                    </div>
                    <div class="group-form">
                        <label for="prenom">prénom</label>
                        <?= inputField('prenom', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "prenom"
                    ], $_POST, $errors) ?>
                    </div>
                </div>
                <div class="group-form-grid">
                    <div class="group-form">
                        <label for="utilisateur">nom d'utilisateur</label>
                        <?= inputField('utilisateur', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "nom d'utilisateur"
                    ], $_POST, $errors) ?>
                    </div>
                    <div class="group-form">
                        <label for="email">Email</label>
                        <?= inputField('email', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "Email"
                    ], $_POST, $errors) ?>
                    </div>
                </div>
                <div class="group-form">
                    <label for="password">Mot de passe</label>
                    <?= inputField('password', [
                    'type' => 'text',
                    'class' => 'input-form',
                    'placeholder' => "mot de passe"
                ], $_POST, $errors) ?>
                </div>
                <button class="button button-primary"><i class="fa fa-add"></i> ajouté</button>
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
    
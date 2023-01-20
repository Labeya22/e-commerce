<?php

$title = "changer le mot de passe";
$id = getQueryParamsString('id');
if (is_null($id) || empty($id)) {
    throw new Exception("Une erreur erreur est survenue");
}

$errors = getErrorUserPass($_POST);
if (empty($errors) && !empty($_POST)) {
    if (changePasswordUser($pdo, $_POST, $id)) {
        $r = generate('admin.users');
        $userEdit = getUser('utilisateur_id', $id);
        $message = "mot de passe modifié.";
        setFlash('success', $message , $r);
        redirect($r);
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
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => ""
                    ], $_POST, $errors) ?>
                    </div>
                    <div class="group-form">
                        <label for="prenom">confirmation du mot de passe</label>
                        <?= inputField('confirm', [
                        'type' => 'text',
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
    
<?php


$title = "ajout d'une marque";

$errors = getErrorsMarque($_POST);

if (empty($errors) && !empty($_POST)) {
    $redirect = generate('admin.marques');
    $marque = $_POST['marque'];
    $create = createMarque($marque);
    if ($create) {
        setFlash('success', "la marque $marque a été ajouté.", $redirect);
    } else {
        setFlash('danger', "la marque $marque n'a  pas pu être ajouté.", $redirect);
    }

    redirect($redirect);
}


?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Ajout d'une marque</h2>
            </div>
            <div class="w-60">
                <form action="" class="form" method="POST">
                    <div class="group-form">
                        <label for="nom">marque</label>
                        <?= inputField('marque', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "marque de vehicule"
                    ], $_POST, $errors) ?>
                    </div>
                    <button class="button button-primary"><i class="fa fa-add"></i> ajouté</button>
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
    
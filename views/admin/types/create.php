<?php


$title = "ajout d'un type";

$errors = getErrorsType($_POST);

if (empty($errors) && !empty($_POST)) {
    $redirect = generate('admin.types');
    $type = $_POST['type'];
    $create = createType($type);
    if ($create) {
        setFlash('success', "le type $type a été ajouté.", $redirect);
    } else {
        setFlash('danger', "le type $type n'a  pas pu être ajouté.", $redirect);
    }

    redirect($redirect);
}


?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Ajout d'un type</h2>
            </div>
            <div class="w-60">
                <form action="" class="form" method="POST">
                    <div class="group-form">
                        <label for="nom">Type</label>
                        <?= inputField('type', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "type de vehicule"
                    ], $_POST, $errors) ?>
                    </div>
                    <button class="button button-primary"><i class="fa fa-add"></i> Ajouter</button>
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
    
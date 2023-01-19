<?php


$title = "editer le type";

$id = getQueryParamsString('marqueid');
if (is_null($id) || empty($id)) {
    throw new Exception("cette marque n'existe pas");
} 

$marque = getMarque($id);
if (empty($marque)) {
    throw new Exception("cette marque n'existe pas");
}

$errors = getErrorsMarque($_POST, $id);

if (empty($errors) && !empty($_POST)) {
    $redirect = generate('admin.marques');
    $value = $_POST['marque'];
    $update = updateMarque([$value, $id]);
    if ($update) {
        setFlash('success', "la marque  $value a été mis à jour.", $redirect);
    } else {
        setFlash('danger', "nous n'avons pas pu mettre à jour la marque {$value} à jour.", $redirect);
    }

    redirect($redirect);
}

?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Editer la marque</h2>
            </div>
            <div class="w-60">
                <form action="" class="form" method="POST">
                    <div class="group-form">
                        <label for="nom">marque</label>
                        <?= inputField('marque', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "type de vehicule"
                    ], $_POST, $errors, $marque['marque']) ?>
                    </div>
                    <button class="button button-primary"><i class="fa fa-edit"></i> editer</button>
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
    
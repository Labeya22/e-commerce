<?php


$title = "editer le type";

$id = getQueryParamsString('typeid');

if (is_null($id) || empty($id)) {
    throw new Exception("ce type n'existe pas");
} 

$type = getTypes($id);
if (empty($type)) {
    throw new Exception("ce type n'existe pas");
}


$errors = getErrorsType($_POST, $id);

if (empty($errors) && !empty($_POST)) {
    $redirect = generate('admin.types');
    $value = $_POST['type'];
    $update = updateType([$value, $id]);
    if ($update) {
        setFlash('success', "le type $value a été mis à jour.", $redirect);
    } else {
        setFlash('danger', "nous n'avons pas pu mettre à jour le type {$value} à jour.", $redirect);
    }

    redirect($redirect);
}


?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Editer le type</h2>
            </div>
            <div class="w-60">
                <form action="" class="form" method="POST">
                    <div class="group-form">
                        <label for="nom">Type</label>
                        <?= inputField('type', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "type de vehicule"
                    ], $_POST, $errors, $type['type']) ?>
                    </div>
                    <button class="button button-primary"><i class="fa fa-edit"></i> Editer</button>
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
    
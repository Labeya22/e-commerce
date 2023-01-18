<?php

$pdo = DATABASE;
$title = "ajout d'un vehicule";

$errors = getErrorVehicule($_POST);


$types = listingTypes($pdo);
$marques = listingMarques($pdo);


if (empty($errors) && !empty($_POST)) {
    $token = generateToken(60);
    saveMemoryData($token, $_POST);
    redirect(generate('admin.vehicule-upload', ['token' => $token]));
}


?>

    <!-- profil -->
    <div class="container">
        <?= flash() ?>
        <div class="section">
            <div class="section-title">
                <h2>Ajout d'un vehicule</h2>
            </div>
            <div class="mb-2">
                <form action="" class="form" method="post">
                    <div class="group-form">
                        <label for="nom">vehicule</label>
                        <?= inputField('vehicule', [
                        'type' => 'text',
                        'class' => 'input-form',
                        'placeholder' => "nom du vehicule"
                    ], $_POST, $errors) ?>
                    </div>
                    <div class="group-form-grid">
                        <div class="group-form">
                            <label for="type">type</label>
                            <?= select('type', [
                                'data' => $_POST,
                                'database' => $types,
                                'value' => 'type_id',
                                'view' => 'type',
                                'class' => 'input-form',
                                'label' => 'type de voiture'
                            ], $errors) ?>
                        </div>
                        <div class="group-form">
                            <label for="marque">marque</label>
                            <?= select('marque', [
                                'data' => $_POST,
                                'database' => $marques,
                                'value' => 'marque_id',
                                'view' => 'marque',
                                'class' => 'input-form',
                                'label' => 'marque de voiture',
                            ], $errors) ?>
                        </div>
                    </div>
                    <div class="group-form-grid">
                        <div class="group-form">
                            <label for="type">evaluation</label>
                            <?= select('star', [
                                'data' => $_POST,
                                'database' => getStar(),
                                'value' => 'index',
                                'view' => 'star',
                                'class' => 'input-form',
                                'label' => 'evaluation du vehicule',
                            ], $errors) ?>
                        </div>
                        <div class="group-form">
                            <label for="promotion">promotion</label>
                            <?= select('promotion', [
                                'data' => $_POST,
                                'database' => getPromotion(),
                                'value' => 'index',
                                'view' => 'promo',
                                'class' => 'input-form',
                                'label' => 'status du  vehicule'
                            ], $errors) ?>
                        </div>
                    </div>
                    <div class="group-form-grid">
                        <div class="group-form">
                            <label for="type">carburant</label>
                            <?= select('carburant', [
                                'data' => $_POST,
                                'database' => getCarburant(),
                                'value' => 'index',
                                'view' => 'index',
                                'class' => 'input-form',
                                'label' => 'carburant du vehicule',
                            ], $errors) ?>
                        </div>
                        <div class="group-form">
                            <label for="stock">stock</label>
                            <?= inputField('stock', [
                                'class' => 'input-form',
                            ], $_POST, $errors) ?>
                        </div>
                    </div>
            
                    <div class="group-form">
                        <label for="description">description</label>
                        <?= textarea('desc', $_POST, $errors) ?>
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
    
<?php


$id = getQueryParamsString('vehiculeid');
$vehicule = getVehicule('vehicule_id', $id);

$title = "editer le vehicule #$id";

$types = listingTypes($pdo);
$marques = listingMarques($pdo);
$uploader = $_FILES['uploader'] ?? [];
$post = $_POST;
$errors = getErrorVehiculeUpdate($post, $uploader, $id);

if (empty($errors) && !empty($post)) {
    $marque = getMarque($post['marque']);
    if (empty($marque)) throw new Exception("une erreur est survenue.");
    // dump($post, $uploader);
    if (!empty($uploader['name'])) {
        $filename = $uploader['name'];
        $temp = $uploader['tmp_name'];
        $basename = pathinfo($filename, PATHINFO_BASENAME);
        $image = createFile($filename, 30);
        $post['image'] = $image;
        $create = updateVehiculeWithImage($post, $id);
        if ($create) {
            $stockId = generateToken(60);
            move($image, $temp);
            $redirect =generate('admin.vehicules');
            setFlash("success", "une voiture a été mis à jour.", $redirect);
            redirect($redirect);
        }
    } else {
        $update = updateVehicule($post, $id);
        if ($update) {
            $redirect = generate('admin.vehicules');
            setFlash("success", "une voiture a été mis à jour.", $redirect);
            redirect($redirect);
        }
    }
}
?>

    <!-- profil -->
    <div class="container">
        <?= flash() ?>
        <div class="section">
            <div class="section-title">
                <h2>Editer le vehicule #...</h2>
            </div>
            <div class="mb-2">
                <form action="" class="form" method="post" enctype="multipart/form-data">
                    <div class="group-form-grid">
                        <div class="group-form">
                            <label for="nom">vehicule</label>
                            <?= inputField('vehicule', [
                            'type' => 'text',
                            'class' => 'input-form',
                            'placeholder' => "nom du vehicule"
                        ], $_POST, $errors, $vehicule['vehicule']) ?>
                        </div>
                        <div class="group-form">
                            <label for="prix">prix</label>
                            <?= inputField('prix', [
                            'type' => 'number',
                            'class' => 'input-form',
                            'placeholder' => "prix du vehicule"
                        ], $_POST, $errors, $vehicule['prix']) ?>
                        </div>
                    </div>
                    <div class="group-form-grid">
                        <div class="group-form">
                            <label for="type">type</label>
                            <?= select('type', [
                                'data' => $_POST,
                                'database' => $types,
                                'value' => 'type_id',
                                'view' => 'type',
                                'update' => $vehicule['typeid'],
                                'class' => 'input-form',
                                'label' => 'type de voiture'
                            ], $errors, $vehicule['type']) ?>
                        </div>
                        <div class="group-form">
                            <label for="marque">marque</label>
                            <?= select('marque', [
                                'data' => $_POST,
                                'database' => $marques,
                                'value' => 'marque_id',
                                'view' => 'marque',
                                'update' => $vehicule['marqueid'],
                                'class' => 'input-form',
                                'label' => 'marque de voiture',
                            ], $errors, $vehicule['marque']) ?>
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
                                'update' => $vehicule['star'],
                                'class' => 'input-form',
                                'label' => 'evaluation du vehicule',
                            ], $errors, $vehicule['star']) ?>
                        </div>
                        <div class="group-form">
                            <label for="promotion">promotion</label>
                            <?= select('promotion', [
                                'data' => $_POST,
                                'database' => getPromotion(),
                                'value' => 'index',
                                'update' => $vehicule['promo'],
                                'view' => 'promo',
                                'class' => 'input-form',
                                'label' => 'promotion'
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
                                'update' => $vehicule['carburant'],
                                'class' => 'input-form',
                                'label' => 'carburant du vehicule',
                            ], $errors) ?>
                        </div>
                        <div class="group-form">
                            <label for="stock">stock</label>
                            <?= inputField('stock', [
                                'class' => 'input-form',
                            ], $_POST, $errors, $vehicule['stock']) ?>
                        </div>
                    </div>
                    <div class="group-form-grid">
                        <div class="group-form">
                            <label for="nom">kilometrage</label>
                            <?= inputField('kilometrage', [
                            'type' => 'text',
                            'class' => 'input-form',
                            'placeholder' => ""
                        ], $_POST, $errors, $vehicule['kilometrage']) ?>
                        </div>
                        <div class="group-form">
                            <label for="transmission">transmission</label>
                            <?= select('transmission', [
                                'data' => $_POST,
                                'database' => getTransmission(),
                                'value' => 'index',
                                'view' => 'index',
                                'class' => 'input-form',
                                'update' => $vehicule['auto'],
                                'label' => 'transmission'
                            ], $errors) ?>
                        </div>
                    </div>
                    <div class="group-form">
                        <label for="nom">image</label>
                        <?= inputField('uploader', [
                            'type' => 'file',
                            'class' => 'input-form'
                        ], $_POST, $errors) ?>
                    </div>
                    <div class="group-form">
                        <label for="description">description</label>
                        <?= textarea('desc', $_POST, $errors, $vehicule['description']) ?>
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
    
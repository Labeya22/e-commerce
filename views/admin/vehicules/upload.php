<?php


$token = getQueryParamsString('token');
if ((is_null($token) || empty($token))) {
    throw new Exception("nous n'avons pas trouvé la référence.");
}

$memory = getSaveMemoryData($token);

if (is_null($memory)) {
    $redirect = generate('admin.vehicule-create');
    setFlash('warning', "délai dépassé, les données ont été supprimé.", $redirect);
    redirect($redirect);
}

$pdo = DATABASE;
$title = "ajouter une image pour le vehicule";


[$post, $expirate] = $memory;

$errors = [];

?>

<!-- profil -->
<div class="container">
    <div class="section">
        <div class="section-title">
            <h2> Ajouter une image pour le vehicule "<?= $post['vehicule'] ?? '' ?>" </h2>
        </div>
        <div class="mb-2">
            <form 
            action="<?= generate('admin.vehicule-uploaded', ['token' => $token]) ?>" 
            class="form w-80" 
            method="POST" 
            id="uploader">
                <div class="group-form">
                    <label for="type">image</label>
                    <?= inputFile('uploader-file', [
                        'class' => 'input-form',
                        'type' => 'file'
                    ], [], $errors) ?>
                </div>
                <div class="progress-area mb-2" >
                    <div class="progress-bar" style="width: 0%;"></div>
                </div>
                <button type="submit" class="button button-primary">
                    <i class="fa fa-cloud-upload"></i>
                    télécharger
                </button>
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

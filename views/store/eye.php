<?php
$title = 'voir le vehicule';

$id = getQueryParamsString('vehicule');

$product = getEyeVehicule($id);
$user = getSession(SESSION_USER);

$isAdd = is_null($user) ? false : hasPanier($id, $user['utilisateur_id']);


?>


<main class="main">
    <div class="section">
        <div class="container">
            <div class="section-title">
                    <h2>Les informations du véhicule</h2>
            </div>
            <div class="product-info">
                    <img src="<?= Image($product['image']) ?>" alt="">
                    <div class="product-details">
                        <h2><?= sprintf('%s %s', $product['marque'], $product['vehicule']) ?></h2>
                    
                        <div class="details">
                            <p>
                                <span class="fa fa-gears"></span> 
                                <?= $product['auto'] ? 'automatique' : 'manuelle' ?>
                            </p>
                            <p><span class="fa fa-gas-pump"></span> <?= $product['carburant'] ?></p>  
                            <p><span class="fa fa-route"></span>  <?= $product['kilometrage'] ?></p>

                            <?php if ($product['promo']): ?>
                                <p class="promo">promotion</p>
                            <?php endif ?>
    
                        </div>
                        <h5 class="price"><?= sprintf("%s$", $product['prix']) ?></h5>
                        <a 
                        id="add-product"
                        class="button button-dark" 
                        href="<?= generate('cart.add', [
                            'vehiculeid' => $product['vehicule_id'
                        ]]) ?>">
                            <?php if ($isAdd): ?>
                            <i class="fa fa-check-double"></i> est dans le panier
                            <?php else: ?>
                                <i class="fa fa-shopping-cart"></i> ajouter
                            <?php endif ?>
                        </a>
                    
                    </div>
                </div>
                <div class="details-eye">
                    <div class="box">
                        <h2>Description</h2>
                        <p><?= $product['description'] ?></p>
                    </div>
            </div>
        </div>
    </div>
</main>
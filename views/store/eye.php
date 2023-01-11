<?php
$title = 'voir le vehicule';

$pdo = getPDO();
$id = getQueryParamsString('vehicule');

['product' => $product, 'media' => $medias] = voirVehicule($pdo, $id);
?>


<main class="main">
    <div class="section">
        <div class="container">
            <div class="section-title">
                    <h2>Les informations du véhicule</h2>
            </div>
            <div class="product-info">
                    <img src="<?= dist("images/vehicules/{$product['image']}") ?>" alt="">
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
                        class="button button-primary" 
                        href="<?= generate('cart', [
                            'add-product' => $product['vehicule_id'
                        ]]) ?>">
                            <i class="fa fa-shopping-cart"></i> Ajouter
                        </a>
                    </div>
                </div>
                <div class="details-eye">
                    <div class="box">
                        <h2>Description</h2>
                        <p><?= $product['description'] ?></p>
                    </div>
                    <div class="box">
                        <h2>Images</h2>
                        <div class="images">
                            <?php foreach ($medias as $media): ?>
                            <img src="<?= media(
                                $product['marque'],
                                $product['vehicule_id'],
                                $media['media']
                            ) ?>" alt="" srcset="">
                            <?php endforeach ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</main>
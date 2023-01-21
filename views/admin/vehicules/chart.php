<?php
$title = 'voir le vehicule';

$id = getQueryParamsString('id');
$product = getEyeVehicule($id);
$year = getQueryParamsString('year') ?? date('Y');
$month = getQueryParamsString('month') ?? date('m');

$stat = getStat($id, $month, $year);


?>


<main class="main">
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h2>Statistique</h2>
            </div>
            <div class="product-info mb-3">
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
                    </div>
                </div>
                <div class="details-eye">
            </div>
            <div class="invoices mb-4"><?= getSortingYear(['admin.vehicule-chart', $id]) ?> </div>
            <div class="invoices mb-10"><?= getSortingMonth(['admin.vehicule-chart', $id]) ?> </div>
            <div class="block">
                <div class="block-title"><?= $stat ?> <?= $stat <= 1 ? 'vendu' : 'vendus'  ?></div>
            </div>
        </div>
    </div>
</main>
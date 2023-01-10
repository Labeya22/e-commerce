<?php
$vehicules = VehiculesPaginer($pdo, 12, getQueryParamsInteger('page'));


?>

<?php  foreach ($vehicules['data'] as $vehicule): ?>
    <div class="card card-xs">
        <div class="thumb">
            <img src="<?= dist("images/vehicules/{$vehicule['image']}") ?>" alt="">
        </div>
        <div class="details">
            <div class="box">
                <h5 class="price"><?= $vehicule['prix'] ?>$</h5>
                <h6 class="title">
                    <a 
                    href="<?= generate('store.eye', ['vehicule' => $vehicule['vehicule_id']]) ?>" 
                    class="cd-name"><?= $vehicule['marque'] . " " . $vehicule['vehicule'] ?>  
                    </a>
                </h6>
                <?php if ($vehicule['promo']): ?>
                <p class="promo">promotion</p>
                <?php endif ?>
                <div class="stars">
                    <ul>
                        <li class="is"><i class="fa fa-star"></i></li>
                        <li class="is"><i class="fa fa-star"></i></li>
                        <li class="is"><i class="fa fa-star"></i></li>
                        <li class="is"><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                </div>
            </div>
            <div class="c-footer">
                <a href="#">
                    <span class="fa fa-route"></span>
                    <?= $vehicule['kilometrage'] ?>
                </a>
                <a href="#">
                    <span class="fa fa-gears"></span>
                    <?php if ($vehicule['auto']): ?>
                    automatique
                    <?php else: ?>
                        manuelle
                    <?php endif ?>
                </a>
                <a href="#">
                    <span class="fa fa-gas-pump"></span>
                    <?= $vehicule['carburant'] ?>
                </a>
            </div>
        </div>
    </div>
<?php  endforeach; ?>
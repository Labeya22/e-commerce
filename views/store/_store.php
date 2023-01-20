<?php
$page = getQueryParamsInteger('page') ?? 1;
$vehicules = getVehiculesPaginer($page);

?>

<?php  foreach ($vehicules['data'] as $vehicule): ?>
    <div class="card card-xs">
        <div class="thumb">
            <img src="<?= Image($vehicule['image']) ?>" alt="">
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
                <?= star($vehicule['star']) ?>

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
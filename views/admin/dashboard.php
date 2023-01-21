<?php

$title = "tableau de board";


$revenus = getFactures();

?>

<!-- contact -->
<div class="container">
    <?= flash() ?>
    <div class="section">
        <div class="section-title">
            <h2>Tableau de bord</h2>
        </div>
        <div class="block text-center">
            <div class="block-title"><?= sprintf('%s$', $revenus) ?></div>
            <p class="block-date"><?= '12 mai 2022' ?></p>
            <p class="block-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, eligendi sequi, illo quod eos nisi illum officia unde modi accusantium, quis aut at architecto alias natus ratione accusamus. Labore, qui.</p>
            <!-- <p class="block-tag"><i class="fa fa-tag"></i> <a href="">aller sur mon compte</a></p> -->
        </div>
        <div class="invoices">
            <a href="<?= generate('admin.vehicules') ?>" class="invoice">
                <h2 class="invoice-title"><?= NVehicule() ?> vehicules</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
            <a href="<?= generate('admin.users') ?>" class="invoice">
                <h2 class="invoice-title"><?= NUsers(); ?> utilisateurs</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
            <a href="<?= generate('admin.types') ?>" class="invoice">
                <h2 class="invoice-title"><?= NTypes() ?> types de voitures</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
            <a href="<?= generate('admin.marques') ?>" class="invoice">
                <h2 class="invoice-title"><?= NMarque() ?>  marque de voiture</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
          
        </div>
    </div>
</div>
<?php

$title = "tableau de board";

?>

<!-- contact -->
<div class="container">
    <?= flash() ?>
    <div class="section">
        <div class="section-title">
            <h2>Tableau de board</h2>
        </div>
        <div class="block text-center">
            <div class="block-title"><?= "400000000$" ?></div>
            <p class="block-date"><?= '12 mai 2022' ?></p>
            <p class="block-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, eligendi sequi, illo quod eos nisi illum officia unde modi accusantium, quis aut at architecto alias natus ratione accusamus. Labore, qui.</p>
            <!-- <p class="block-tag"><i class="fa fa-tag"></i> <a href="">aller sur mon compte</a></p> -->
        </div>
        <div class="invoices">
            <a href="<?= generate('admin.users') ?>" class="invoice">
                <h2 class="invoice-title">15 types des voitures</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
            <a href="<?= generate('admin.users') ?>" class="invoice">
                <h2 class="invoice-title">15 utilisateurs</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
            <a href="<?= generate('admin.users') ?>" class="invoice">
                <h2 class="invoice-title">15 vehicules</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
            <a href="<?= generate('admin.users') ?>" class="invoice">
                <h2 class="invoice-title">15 marque de voiture</h2>
                <p class="invoice-date"><?= '' ?></p>
            </a>
          
        </div>
    </div>
</div>
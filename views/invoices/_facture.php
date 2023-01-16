<?php foreach ($factures['data'] as $facture): ?>
    <a href="<?= generate('facture.eye', ['factureid' => $facture['facture_id']]) ?>" class="invoice">
        <h2 class="invoice-title">Facture n°<?= $facture['facture_id'] ?></h2>
        <p class="invoice-date"><?= dateFormat($facture['create_at']) ?></p>
    </a>
<?php endforeach ?>
<?php
checkUser(generate('user'));

$pdo = getPDO();

$user = getSession(SESSION_USER);

$userid = $user['utilisateur_id'];
$factureid = getQueryParamsInteger('factureid');
if (is_null($factureid)) {
    throw new Exception("le paramètre factureid est incorrect");
}

$facture = getFactureEye([$userid, $factureid]);
if (empty($facture)) {
    throw new Exception("Aucune facture trouvée.");
}
$products = json_decode($facture['cart'], true);
?>

    <div class="facture">facture n°<?= $facture['facture_id'] ?></div>
        <!-- header -->
        <div class="header">
            <div class="header-id">
                <i class="fa fa-car"></i> vente-vehicule</strong>
            </div>
            <div class="header-options">
                <a href="" id="print"><i class="fa fa-print"></i> imprimer</a>
            </div>
        </div>
        <!-- divised -->
        <div class="divised"></div>
        <!-- header -->
        <!-- info -->
        <div class="info">
            <div class="info-client">
                <p><strong>nom</strong> : <?= $facture['nom']  ?></p>
                <p><strong>prénom</strong> : <?= $facture['prenom']  ?></p>
                <p><strong>nom d'utiliateur</strong> : <?= $facture['utilisateur']  ?></p>
            </div>
            <div class="info-account">
                <p><strong>payé par</strong> : banque</p>
                <p><strong>date </strong> : <?= $facture['create_at']  ?></p>
                <p><strong>numéro du compte</strong> : <?= $facture['numberAccount'] ?></p>
            </div>
        </div>

        <table class="product" id="table-responsive">
            <thead>
                <tr>
                    <th>vehicule</th>
                    <th>marque</th>
                    <th>prix</th>
                    <th>nombres</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['vehicule'] ?></td>
                    <td><?= $product['marque'] ?></td>
                    <td><?= $product['prix'] ?>$</td>
                    <td>x <?= $product['quantite'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

<div class="total"><?= $facture['total'] ?> $</div>
  
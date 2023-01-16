<?php
checkUser(generate('user'));

$pdo = getPDO();

$user = getSession(SESSION_USER);

$userid = $user['utilisateur_id'];

$page = getQueryParamsInteger('page');
$factures = getFacturesPaginer($userid, $page);
?>

<main class="main">
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h2>Tous les factures</h2>
            </div>
            <div class="invoices">
                <?php require inc('invoices/_facture.php') ?>
            </div>
            <div class="pagination">
                <?= pagination($factures['options']) ?>
            </div>
        </div>
    </div>
</main>
<?php
$title = 'transactions';

checkUser(generate('user'));

$pdo = DATABASE;

$user = getSession(SESSION_USER);


$banque = getBanque($user['utilisateur_id']);
?>


<main class="main">
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h2>Mon solde</h2>
            </div>
            <div class="solde"><?= $banque['solde'] ?>$</div>
        </div>
    </div>
</main>
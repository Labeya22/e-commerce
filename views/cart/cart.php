<?php
checkUser(generate('user'));

$title = "panier";

$pdo = getPDO();

$user = getSession(SESSION_USER);

$page = getQueryParamsInteger('page') ?? 1;
$carts = cartPaginer($pdo, $user['utilisateur_id'], 12, $page);

$taux = getTaux();

?>

<div class="border"></div>
<main class="main">
    <div class="section section-sm">
        <div class="container">
            <div class="section-title">
                <h2>Panier</h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga eveniet temporibus illum, odit tenetur cumque, dolores necessitatibus at error, quasi inventore numquam. 
                    Velit enim facere error explicabo inventore quo fuga!
                </p>
            </div>
            <form action="<?= generate('cart.checkout') ?>" method="POST" class="carts" id="carts">
                <div class="cart-group">
                    <?php require inc('cart/_cart.php') ?>
                </div>
                <?php if (!empty($carts['data'])): ?>
                <div class="cart-total">
                    <h4>Total à payer</h4>
                    <input 
                        type="hidden"
                        name="total" 
                        id="price-input" 
                        placeholder="2000">
                    <div class="box">
                        <label for="tva-ok" title="généré une facture directement.">Généré une facture</label>
                        <input type="checkbox" id="facture" name="facture" class="checkbox">
                    </div>
                    <div class="prices" id="prices"></div>
                    
                    <button type="submit" class="button button-dark d-block"> 
                        <i class="fa fa-money-bill"></i> 
                        Acheter
                    </buttton>
                </div>
                <?php endif; ?>
            </form>

            <div class="pagination js-filter-pagine">
                <?= pagination($carts['options']) ?>
            </div>
        </div>
    </div>

    <!-- <div class="modal" element="buy">
        <i class="fa fa-xmark close-modal"></i>

        <div class="modal-content">
            <div class="modal-title">
                <h4>confirmation du paiement</h4>
            </div>
            <div class="modal-divised"></div>
            <div class="modal-body">
                <form action="<?= generate('cart.buy') ?>" class="form" method="post" id="checkout">
                    <div class="group-form mb-2 el-account">
                        <label for="account">numéro du compte</label>
                            <?= inputField('account', [
                            'type' => 'text',
                            'class' => 'input-form',
                            'placeholder' => ""
                        ], $_POST, []) ?>
                    </div>
                    <div class="group-form mb-2 el-secret">
                        <label for="secret">code secret</label>
                            <?= inputField('secret', [
                            'type' => 'password',
                            'class' => 'input-form',
                            'placeholder' => ""
                        ], $_POST, []) ?>
                    </div>
                    <div class="group-form mb-2">
                        <label for="total">Total </label>
                        <input 
                        class="input-form" 
                        type="number" 
                        name="total" 
                        placeholder="2000" disabled>
                    </div>

                    <button class="button button-primary"><i class="fa fa-copy"></i> Envoyer</button>
                </form>
            </div>
        </div>
    </div> -->
</main>

<a href="#" class="scrolltop" id="scrolltop"><i class="fa fa-circle-chevron-up"></i></a>
<div class="container">
    <footer class="footer">
        <p>&copy; vente-car, Tous droits réservés</p>
    </footer>
</div>
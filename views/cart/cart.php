<?php
checkUser(generate('user'));

$title = "panier";

$pdo = getPDO();

$user = getSession(SESSION_USER);

$page = getQueryParamsInteger('page') ?? 1;
$carts = cartPaginer($pdo, $user['utilisateur_id'], 12, $page);

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
            <form action="" method="GET" class="carts" id="carts">
                <div class="cart-group">
                    <?php require inc('cart/_cart.php') ?>
                </div>
                <div class="cart-total">
                    <h4>Total à payer</h4>
                    <div class="box">
                        <span>TVA</span>
                        <span TVA="0.16">16%</span>
                    </div>
                    <div class="box">
                        <span>Taux d'echange</span>
                        <span>2000fc</span>
                    </div>

                    <div class="box">
                        <label for="tva-ok" title="généré une facture directement.">Généré une facture</label>
                        <input type="checkbox" id="tva-ok" name="tva-ok" class="checkbox">
                    </div>
                    <div class="prices" id="prices"></div>

                    <input type="hidden" value="0" name="prices" id="price-input">
                    
                    <button type="submit" class="button button-dark d-block" id="buy"> 
                        <i class="fa fa-money-bill"></i> 
                        Acheter
                    </buttton>
                </div>
            </form>

            <div class="pagination js-filter-pagine">
                <?= pagination($carts['options']) ?>
            </div>
        </div>
    </div>
</main>
<a href="#" class="scrolltop" id="scrolltop"><i class="fa fa-circle-chevron-up"></i></a>
    <div class="container">
        <footer class="footer">
            <p>&copy; vente-car, Tous droits réservés</p>
        </footer>
    </div>
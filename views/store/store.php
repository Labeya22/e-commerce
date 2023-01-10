<?php
$title = "stores";
$pdo = getPDO();

$types = listingTypes($pdo);
$marques = listingMarques($pdo);
$vehicules = VehiculesPaginer($pdo, 12, getQueryParamsInteger('page'));
?>

    <!-- store -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h1>Boutique</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci praesentium similique maiores. Facere laudantium at maiores eius id praesentium vero quam. Distinctio atque consequuntur soluta, dicta obcaecati voluptatem magnam recusandae.
                </p>
            </div>

            <div class="products" id="js-filter">
                <form class="filter js-filter-form" id="filter" action="<?= generate('store')  ?>">
                    <div class="filter-element">
                        <?= input('q', [
                            'type' => 'text',
                            'class' => 'filter-input filter-search',
                            'placeholder' => 'Recherche une vehicule'
                        ], $_GET) ?>
                    </div>
                    <div class="filter-element">
                        <h4>voir par type</h4>
                        <div class="box">
                            <?= select('type', [
                                'data' => $_GET,
                                'database' => $types,
                                'value' => 'type',
                                'view' => 'type',
                                'class' => 'filter-input filter-type',
                                'label' => 'type de voiture'
                            ]) ?>
                        </div>
                    </div>
                    <div class="filter-element">
                        <h4>voir par marque</h4>
                        <div class="box">
                            <?= select('marque', [
                                'data' => $_GET,
                                'database' => $marques,
                                'value' => 'marque',
                                'view' => 'marque',
                                'class' => 'filter-input filter-marque',
                                'label' => 'marque de voiture'
                            ]) ?>
                        </div>
                    </div>
                    <div class="filter-element">
                        <h4>Promotion</h4>
                        <div class="box">
                            <?= checkbox('promo', 'promotion', $_GET) ?>
                            <label for="promo">en promotion</label>
                        </div>
                    </div>
                    <button class="button button-sm button-primary d-block" type="submit"><i class="fa fa-filter"></i> Filtre</button>
                </form>
                <div class="product-list">
                    <div class="product-box js-filter-content">
                     <?php require inc('store/_store.php') ?>
                    </div>

                    <div class="pagination js-filter-pagine">
                        <?= pagination($vehicules['options']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- store  -->

    <a href="#" class="scrolltop" id="scrolltop"><i class="fa fa-circle-chevron-up"></i></a>
    <div class="container">
        <footer class="footer">
            <p>&copy; vente-car, Tous droits réservés</p>
        </footer>
    </div>
    
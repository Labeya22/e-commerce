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
                <h1>Mon profil</h1>
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
    
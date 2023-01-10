<?php

/**
 * Listing de tous les categories
 *
 * @return array
 */
function listingTypes(PDO $pdo): array {
    $req = $pdo->query("SELECT * FROM types");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
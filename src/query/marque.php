<?php

/**
 * Permet lister les marques
 *
 * @param PDO $pdo
 * @return array
 */
function listingMarques(PDO $pdo): array {
    $req = $pdo->query("SELECT * FROM marques");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
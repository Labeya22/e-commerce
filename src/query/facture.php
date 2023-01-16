<?php


function createFacture(array $data) {
    $pdo = DATABASE;
    $query = "INSERT INTO factures SET cart = ?, total = ?, utilisateurid = ?, create_at = NOW()";
    $req = $pdo->prepare($query);
    return $req->execute($data);
}
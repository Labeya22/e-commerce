<?php


function getTaux() {
    /**
     * @var PDO
     */
    $pdo = DATABASE;
    $req = $pdo->query("SELECT * FROM taux");
    return $req->fetch();
}
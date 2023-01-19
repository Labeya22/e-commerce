<?php

function createParameters($product, $post) {
    $pdo = DATABASE;
    $generateId = generateToken(60);
    $req = $pdo->prepare("INSERT INTO parametres SET 
    vehiculeid = :pr, kilometrage = :ki, 
    carburant = :ca , auto = :au ,param_id = :id");
    return $req->execute([
        ':id' => $generateId,
        ':ca' => $post['carburant'],
        ':ki' => $post['kilometrage'],
        ':au' => $post['transmission'],
        ':pr' => $product,
    ]);
}
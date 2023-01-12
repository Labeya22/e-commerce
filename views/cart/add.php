<?php

checkUser(generate('user'));

$pdo = getPDO();

$user = getSession(SESSION_USER);

$cartid = getQueryParamsString('cartid');

if (is_null($cartid) || empty($cartid)) {
    throw new Exception("nous n'avons pas pu trouver le panier #$cartid");
}

$cart = getCart($pdo, 'panier_id', $cartid);

if (empty($cart)) {
    throw new Exception("nous n'avons pas pu trouver le panier #$cartid");
}

$delete = deleteCart($pdo, $user['utilisateur_id'], $cart['panier_id']);
echo json_encode(['success' => true]);
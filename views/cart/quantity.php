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

$quantity = getQueryParamsInteger('quantity');
if (empty($quantity) || is_null($quantity)) {
    throw new Exception("la quantité ne doit pas être vide.");
}
echo json_encode(['success' => changeQuantity($pdo, $cart, $quantity)]);

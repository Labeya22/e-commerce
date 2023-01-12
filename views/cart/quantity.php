<?php

checkUser(generate('user'));

$pdo = getPDO();

$user = getSession(SESSION_USER);

$cardid = getQueryParamsString('cardid');

if (is_null($cardid) || empty($cardid)) {
    throw new Exception("nous n'avons pas pu trouver le panier #$cardid");
}

$card = getCart($pdo, 'panier_id', $cardid);

if (empty($card)) {
    throw new Exception("nous n'avons pas pu trouver le panier #$cardid");
}

$change = changeQuantity($pdo, $card['panier_id'], 4);

echo json_encode(['success' => true]);

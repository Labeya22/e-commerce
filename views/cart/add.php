<?php

checkUser(generate('user'));

$pdo = getPDO();

$user = getSession(SESSION_USER);

$vehiculeid = getQueryParamsString('vehiculeid');

if (is_null($vehiculeid) || empty($vehiculeid)) {
    throw new Exception("nous n'avons pas pu trouver le vehicule #$vehiculeid");
}

$vehicule = getVehicule('vehicule_id', $vehiculeid);

if (empty($vehicule)) {
    throw new Exception("nous n'avons pas pu trouver le vehicule #$vehiculeid");
}

$add = addCart([
    'user' => $user['utilisateur_id'],
    'product' => $vehicule['vehicule_id']
]);

echo json_encode($add);
<?php

checkUser(generate('user'));

$pdo = DATABASE;
$user = getSession(SESSION_USER);
$cart = getCartAll($pdo, 'utilisateurid', $user['utilisateur_id']);
echo json_encode(['news' => !empty($cart)]);

<?php

checkUser(generate('user'));

$user = getSession(SESSION_USER);
$cart = getCartAll('utilisateurid', $user['utilisateur_id']);
echo json_encode(['news' => !empty($cart)]);

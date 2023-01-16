<?php

checkUser(generate('user'));

$pdo = DATABASE;

$user = getSession(SESSION_USER);


$notifications = bell($user['utilisateur_id'], true);

echo $notifications;

?>
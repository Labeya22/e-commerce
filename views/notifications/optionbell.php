<?php

checkUser(generate('user'));

$pdo = DATABASE;

$user = getSession(SESSION_USER);

$eye = getNotificationNoEye($user['utilisateur_id']);

echo json_encode(['eye' => $eye]);

?>
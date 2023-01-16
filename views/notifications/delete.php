<?php

checkUser(generate('user'));

$pdo = DATABASE;

$user = getSession(SESSION_USER);

$notif = getQueryParamsInteger('notifid');
if (is_null($notif)) {
    echo json_encode(['danger' => "impossible de supprimer la notification."]);
} else {
    $notification = getNotifcation($notif);
    if (empty($notification)) {
        echo json_encode(['danger' => "impossible de supprimer la notification."]);
    } else {
        echo json_encode([
            'success' => deleteNotification($notification['notif_id']),
            'id' => $notif
        ]);
    }
}



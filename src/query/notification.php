<?php


/**
 * @param string $user
 * 
 * @return array
 */
function getNotificationLimit(string $user): array {
    $pdo = DATABASE;
    $query = "SELECT * FROM notifications WHERE utilisateurid = ? ORDER BY create_at DESC LIMIT 3";
    $req = $pdo->prepare($query);
    $req->execute([$user]);
    return $req->fetchAll();
}

/**
 * @param string $notifid
 * 
 * @return array
 */
function getNotifcation(string $notifid): array {
    $pdo = DATABASE;
    $query = "SELECT * FROM notifications WHERE notif_id = ?";
    $req = $pdo->prepare($query);
    $req->execute([$notifid]);
    return $req->fetch();
}

function getNotificationAll(string $user): array {
    $pdo = DATABASE;
    $query = "SELECT * FROM notifications WHERE utilisateurid = ? ORDER BY create_at DESC ";
    $req = $pdo->prepare($query);
    $req->execute([$user]);
    return $req->fetchAll();
}

function createNotification(array $params) {
    $pdo = DATABASE;
    $query = "INSERT INTO notifications 
    SET title = :ti,
    utilisateurid = :us,
    content = :co, 
    create_at = NOW()";
    $req = $pdo->prepare($query);
    return $req->execute([
        ':us' => $params['user'],
        ':ti' => $params['title'],
        ':co' => $params['content'],
    ]);
}

/**
 * @param string $notifid
 * 
 * @return bool
 */
function deleteNotification(string $notifid): bool {
    $pdo = DATABASE;
    $query = "DELETE FROM notifications WHERE notif_id = ? ";
    $req = $pdo->prepare($query);
    return $req->execute([$notifid]);
}

function setEye($notifid) {
    $pdo = DATABASE;
    $query = "UPDATE notifications SET eye = 1 WHERE notif_id = ? AND eye = 0 ";
    $req = $pdo->prepare($query);
    return $req->execute([$notifid]);
}

function setEyeAll($user) {
    $pdo = DATABASE;
    $query = "UPDATE notifications SET eye = 1 WHERE utilisateurid = ? AND eye = 0 ";
    $req = $pdo->prepare($query);
    return $req->execute([$user]);
}


function getNotificationNoEye($user) {
    $pdo = DATABASE;
    $query = "SELECT * FROM notifications WHERE utilisateurid = ? AND eye = 0 ";
    $req = $pdo->prepare($query);
    $req->execute([$user]);
    return !empty($req->fetchAll());
}
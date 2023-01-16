<?php

checkUser('user');


$user = getSession(SESSION_USER);

$notif = getQueryParamsInteger('notifid');
if (is_null($notif)) {
    throw new Exception("notification introuvable");
}

$notification = getNotifcation($notif);

if (empty($notification)) {
    throw new Exception("notification introuvable");
}
setEye($notification['notif_id']);

?>

<main class="main">
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h2>notifications</h2>
            </div>
            <div class="d-block">
            <div class="block" id="block-notification">
                <div class="block-title"><?= $notification['title'] ?></div>
                    <p class="block-date"><?= $notification['create_at'] ?></p>
                    <p class="block-content"><?= $notification['content'] ?></p>
                    <p class="block-tag"><i class="fa fa-tag"></i> <a href="">aller sur mon compte</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

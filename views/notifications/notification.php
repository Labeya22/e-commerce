<?php

checkUser(generate('user'));

$pdo = DATABASE;

$user = getSession(SESSION_USER);

$notifications = getNotificationAll($user['utilisateur_id']);

setEyeAll($user['utilisateur_id']);

?>


<main class="main">
    <div class="section">
        <div class="container">
            <div class="section-title">
                <h2>notifications</h2>
            </div>
            <div class="d-block">
                <?php require inc("notifications/_notification.php") ?>
            </div>
        </div>
    </div>
</main>

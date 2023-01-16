<?php foreach ($notifications as $notif):  ?>
<div class="block" id="block-notification">
    <div class="block-title"><?= $notif['title'] ?></div>
    <p class="block-date"><?= $notif['create_at'] ?></p>
    <p class="block-content"><?= $notif['content'] ?></p>
    <p class="block-tag"><i class="fa fa-tag"></i> <a href="">aller sur mon compte</a></p>
    <div class="block-btn">
        <a 
        id="delete-notification"
        href="<?= generate('notif.delete', ['notifid' => $notif['notif_id']]) ?>" 
        class="button  button-danger">
            <i class="fa fa-minus"></i> 
            supprimer
        </a>
        <a  
        href="<?= generate('notif.eye', ['notifid' => $notif['notif_id']]) ?>"  
        class="button  button-light">
        <i class="fa fa-eye"></i> 
            voir
        </a>
    </div>
</div>
<?php endforeach ?>
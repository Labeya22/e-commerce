<?php


$id = getQueryParamsString('id');

$user = getUser('utilisateur_id', $id);
if (empty($user)) {
    throw new Exception("nous n'avons pas trouvé l'utilisateur #$id");
}

?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Information de l'utilisateur #<?=  $user['utilisateur'] ?></h2>
            </div>

            <?= flash() ?>

            <div class="myprofil">
                <p class="myprofil-info"><strong>nom</strong> : <?= $user['nom'] ?></p>
                <p class="myprofil-info"><strong>prénom</strong> : <?= $user['prenom'] ?></p>
                <p class="myprofil-info"><strong>nom d'utilisateur</strong> : <?= $user['utilisateur'] ?></p>                
                <p class="myprofil-info"><strong>email</strong> : <?= $user['email'] ?></p>                
                <p class="myprofil-info">mot de passe : <strong>********</strong> 
                    <a 
                    href="<?= generate('admin.user-change', ['id' => $user['utilisateur_id']]) ?>" 
                    class="button button-primary button-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                </p>
                <p class="myprofil-info"><strong>date de création</strong> : <?= dateFormat($user['create_at']) ?></p>
                <?php if (!is_null($user['update_at'])): ?>
                    <p class="myprofil-info"><strong>dernière modification</strong> : <?= dateFormat($user['update_at']) ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
     <!-- profil  -->

    <a href="#" class="scrolltop" id="scrolltop"><i class="fa fa-circle-chevron-up"></i></a>
    <div class="container">
        <footer class="footer">
            <p>&copy; vente-car, Tous droits réservés</p>
        </footer>
    </div>
    
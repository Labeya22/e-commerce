<?php

checkUser(generate('user'));

$title = "mon profil";

$user = getSession(SESSION_USER);
?>

    <!-- profil -->
    <div class="container">
        <div class="section">
            <div class="section-title">
                <h2>Mon profil</h2>
            </div>

            <?= flash() ?>

            <div class="myprofil">
                <p class="myprofil-info"><strong>nom</strong> : <?= $user['nom'] ?></p>
                <p class="myprofil-info"><strong>prénom</strong> : <?= $user['prenom'] ?></p>
                <p class="myprofil-info"><strong>nom d'utilisateur</strong> : <?= $user['utilisateur'] ?></p>                
                <p class="myprofil-info"><strong>email</strong> : <?= $user['email'] ?></p>                
                <p class="myprofil-info">mot de passe : <strong>********</strong> 
                    <a 
                    href="<?= generate('user.change-pass', ['userid' => $user['utilisateur_id']]) ?>" 
                    class="button button-primary button-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                </p>
                <p class="myprofil-info"><strong>date de création</strong> : <?= dateFormat($user['create_at']) ?></p>
                <?php if (!is_null($user['update_at'])): ?>
                    <p class="myprofil-info"><strong>dernière modification</strong> : <?= dateFormat($user['update_at']) ?></p>
                <?php endif ?>
                <p class="myprofil-info"> <a href="<?= generate('trans.home') ?>">voir les transactions</a> </p> 

                <div class="myprofil-action">
                    <a 
                    href="<?= generate('user.delete', ['userid' => $user['utilisateur_id']]) ?>" 
                    class="button button-danger" 
                    onclick="return confirm('<?= $user['nom'] ?> tu veux vraiment supprimer ton compte ?')">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="<?= generate('user.edit', ['userid' => $user['utilisateur_id']]) ?>" class="button button-primary"><i class="fa fa-edit"></i> </a>
                </div>
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
    
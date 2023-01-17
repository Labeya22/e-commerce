<?php
$admin = getSession(SESSION_ADMIN);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= dist('css/app.css') ?>">
    <link rel="stylesheet" href="<?= dist('css/toast.css') ?>">
    <link rel="stylesheet" href="<?= dist('vendor/fontawesome/css/all.css') ?>">
    <link rel="shortcut icon" href="<?= dist('images/favicon.svg') ?>" type="image/x-icon">
    
    <script src="<?= dist('js/app.js') ?>" type="module" defer></script>
    <script src="<?= dist('js/admin.js') ?>" type="module" defer></script>
    <script src="<?= dist('js/message.js') ?>" type="module" defer></script>
    <title> administraction<?= isset($title) ? sprintf(" | %s", $title) : ''  ?></title>
</head>
<body>
        <!-- header -->
    <div class="header" id="header">
        <nav class="nav" id="nav">
            <a class="brand" href="#">
                <span class="fa fa-car brand-icon"></span>
                <span class="brand-text">vehicule-vente</span>
            </a>
            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list">
                    <?=  li('Tableau de bord', generate('admin.dash')) ?>
                    <?=  li('Types', generate('admin.types')) ?>
                    <?=  li('Marques', generate('store')) ?>
                    <?=  li('Vehicules', generate('facture.all')) ?>
                </ul>
                <span class="fa fa-xmark close-nav-menu" id="close-nav"></span>
            </div>
            <div class="nav-options">
             <?php if (hasSession(SESSION_ADMIN)) : ?>
                
                <?= bell($user['utilisateur_id']) ?>
             
                <div class="nav-option">
                    <span class="separator">|</span>
                </div>
                    <div class="nav-option">
                        <?= linkOption(generate('user.profil'), 'fa fa-user') ?>
                    </div>
                    <div class="nav-option">
                        <?= linkOption(generate('user.logout'), 'fa fa-sign-out', [
                            'onclick' => "return confirm('Vous voulez vraiment effectuer cette action.')"
                        ]) ?>
                    </div>
                <?php else: ?>
                    <?= linkOption(generate('user'), 'fa fa-sign-in') ?>
                <?php endif ?>
                <div class="nav-option screen-sm" id="navbar">
                    <a href="#" class="link-option"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </nav>
    </div>
    <!-- end header -->
    <main class="main"><?= $content ?></main>

    <!-- preloader -->
    <div id="preloader"></div>

</body>
</html>
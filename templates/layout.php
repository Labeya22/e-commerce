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
    <title> vente de vehicule<?= isset($title) ? sprintf(" | %s", $title) : ''  ?></title>
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
                    <?=  li('Accueil', generate('home')) ?>
                    <?=  li('A propos', generate('about')) ?>
                    <?=  li('Stores', generate('store')) ?>
                    <?=  li('Stores', generate('contact')) ?>
                </ul>
                <span class="fa fa-xmark close-nav-menu" id="close-nav"></span>
            </div>
            <div class="nav-options">
                <div class="nav-option">
                    <?= linkOption(generate('cart'), 'fa fa-shopping-cart', [], 'no-eye') ?>
                </div>
                <div class="nav-option">
                    <a href="#" class="link-option no-eye" id="option-bell"><i class="fa fa-bell"></i></a>
                  
                    <div class="absolute-list nav-bell " id="nav-bell">
                        <h4>notifications</h4>
                        <div class="bell-body">
                            <a href="#">
                                <h5>Panier</h5>
                                <p>
                                    vous avez un nouveau produit dans le panier
                                </p>
                                <span class="date">19 mai 2022</span>
                            </a>
                            <a href="#">
                                <h5>Panier</h5>
                                <p >
                                    vous avez un nouveau produit dans le panier
                                </p>
                                <span class="date">19 mai 2022</span>
                            </a>
                            <a href="#">
                                <h5>Panier</h5>
                                <p >
                                    vous avez un nouveau produit dans le panier
                                </p>
                                <span class="date">19 mai 2022</span>
                            </a>
                        </div>
                        <a class="bell-footer" href="#">Toutes les notifications</a>
                    </div>
                </div>
             
                <div class="nav-option">
                    <span class="separator">|</span>
                </div>
                <?php if (hasSession(SESSION_USER)) : ?>
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

    <script src="<?= dist('js/app.js') ?>" type="module"></script>
    <script src="<?= dist('js/message.js') ?>" type="module"></script>

    <script src="<?= dist('vendor/typewriterjs/dist/core.js') ?>"></script>

    <script type="text/javascript">
        (function () {
            const write = document.querySelector('#write')
            if (write) {
                const options = {
                    strings: ['rapidement', 'facilement', 'simplement'],
                    autoStart: true,
                    loop: true
                }
                const instance = new Typewriter('#write', options);
            }
        }())
    </script>
    <div id="preloader"></div>

</body>
</html>
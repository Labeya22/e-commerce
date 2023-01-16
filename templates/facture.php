<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= dist('css/toast.css') ?>">
    <link rel="stylesheet" href="<?= dist('css/facture.css') ?>">
    <link rel="stylesheet" href="<?= dist('vendor/fontawesome/css/all.css') ?>">
    <link rel="shortcut icon" href="<?= dist('images/favicon.svg') ?>" type="image/x-icon">
    <script src="<?= dist('js/app.js') ?>" type="module" defer></script>
    <title> vente de vehicule<?= isset($title) ? sprintf(" | %s", $title) : ''  ?></title>

</head>
<body>
  <div class="container">
    <?= $content ?>
  </div>
  
  <script src="{{ source('js/app.js') }}" type="module"></script>
</body>
</html> 
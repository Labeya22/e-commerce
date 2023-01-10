<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= dist('css/user.css') ?>">
    <link rel="stylesheet" href="<?= dist('css/toast.css') ?>">
    <link rel="stylesheet" href="<?= dist('vendor/fontawesome/css/all.css') ?>">
    <link rel="shortcut icon" href="<?= dist('images/favicon.svg') ?>" type="image/x-icon">
    <title> Utilisateur <?= isset($title) ? sprintf(" | %s", $title) : ''  ?></title>
    <script src="<?= dist('js/user.js') ?>" type="module" defer></script>

    <title>Document</title>
</head>
<body>
    <?= $content ?>


</body>
</html>
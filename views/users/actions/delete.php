<?php


checkUser(generate('user'));

$title = "stores";
$pdo = getPDO();

$userid = getQueryParamsString('userid');
if (is_null($userid) || empty($userid)) {
    throw new Exception("Une erreur erreur est survenue");
}

$user = getSession(SESSION_USER);
if ($userid != $user['utilisateur_id']) {
    throw new Exception("nous avons pas trouvé cet utilisateur.");
}

if (deleteUser($pdo, $user['utilisateur_id'])) {
    deleteSession(SESSION_USER);
    redirect(generate('user'));
}

redirect(generate('user.profil'));

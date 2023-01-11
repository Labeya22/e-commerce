<?php
// on vérifie si l'utilisateur est connecté
checkUser(generate('user'));

//  message de déconnexion
$user = getSession(SESSION_USER);
$message = sprintf("vous êtes déconnecté %s", $user['utilisateur']);
setFlash('success', $message , generate('user'));

// on supprime la session (on déconnecte l'utilisateur)
deleteSession(SESSION_USER);


// on redirige vers la page login
redirect(generate('user'));
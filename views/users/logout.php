<?php
// on vérifie si l'utilisateur est connecté
checkUser(generate('user'));
// on supprime la session (on déconnecte l'utilisateur)
deleteSession(SESSION_USER);
// on redirige vers la page login
redirect(generate('user'));
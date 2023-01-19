<?php

$userid = getQueryParamsString('userid');
if (is_null($userid) || empty($userid)) {
    echo json_encode(['error' => "l'identifiant envoyé est incorrect."]);
} else {
    $delete = deleteUser($userid);
    echo json_encode([
        'success' => $delete,
        'message' => "un utilisateur  supprimé."
    ]);
}


<?php

$marqueid = getQueryParamsString('marqueid');
if (is_null($marqueid) || empty($marqueid)) {
    echo json_encode(['error' => "l'identifiant envoyé est incorrect."]);
} else {
    $delete = deleteMarque($marqueid);
    echo json_encode([
        'success' => $delete,
        'message' => "une marque de voiture supprimé."
    ]);
}


<?php

$vehiculeid = getQueryParamsInteger('vehiculeid');
dump($vehiculeid);
if (is_null($vehiculeid) || empty($vehiculeid)) {
    echo json_encode(['error' => "l'identifiant envoyé est incorrect."]);
} else {
    $delete = deleteVehicule($vehiculeid);
    echo json_encode([
        'success' => $delete,
        'message' => "un vehicule supprimé."
    ]);
}
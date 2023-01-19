<?php

$vehiculeid = getQueryParamsString('vehiculeid');
if (is_null($vehiculeid) || empty($vehiculeid)) {
    echo json_encode(['error' => "l'identifiant envoyé est incorrect."]);
} else {
    $vehicule = getVehicule('vehicule_id', $vehiculeid);
    if (!empty($vehicule)) {
        removeFile([$vehicule['marque'], $vehicule['image']]);
        $delete = deleteVehicule($vehiculeid);
        echo json_encode([
            'success' => $delete,
            'message' => "un vehicule supprimé."
        ]);
    } else {
        
    }
}
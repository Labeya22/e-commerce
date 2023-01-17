<?php

$typeid = getQueryParamsInteger('typeid');
if (is_null($typeid) || empty($typeid)) {
    echo json_encode(['error' => "l'identifiant envoyé est incorrect."]);
} else {
    $delete = deleteType($typeid);
    echo json_encode([
        'success' => $delete,
        'message' => "un type de voiture supprimé."
    ]);
}


<?php


$error = null;

$user = getSession(SESSION_USER);
if (is_null($user)) {
    $r = generate('user');
    setFlash('warning', 'pour ajouter un produit dans le panier, vous devez être connecter.', $r);
    echo json_encode(['redirect' => $r]);
} else  {

    $pdo = DATABASE;

    $vehiculeid = getQueryParamsString('vehiculeid');
    
    if (is_null($vehiculeid) || empty($vehiculeid)) {
        $error = "nous n'avons pas pu trouver le vehicule #$vehiculeid";
    } else {
 
        $vehicule = getVehicule('vehicule_id', $vehiculeid);
    
        if (empty($vehicule)) {
            $error = "nous n'avons pas pu trouver le vehicule #$vehiculeid";
        } else {
    
            if (empty($error)) {
                $add = addCart([
                    'user' => $user['utilisateur_id'],
                    'product' => $vehicule['vehicule_id'],
                ]);
        
                echo json_encode($add);
            } else {
                echo json_encode(['error' => $error]);
            }
        }
    } 
}

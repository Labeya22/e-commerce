<?php

checkUser(generate('user'));

$pdo = getPDO();

$user = getSession(SESSION_USER);

$userid = $user['utilisateur_id'];
if (!empty($_POST)) {
    $banque = getBanque($userid);
    if (empty($banque)) {
        echo json_encode(["warning" => "nous n'avons pas trouver le compte #$userid"]);
    } else {
        $solde = (float)$banque['solde'];
        $total = (float)$_POST['total'];
        if ($total > $solde) {
            echo json_encode(['warning' => "il vous reste que {$solde}$ dans votre compte."]);
        } else {
    
            $paye = $solde - $total;
            $ok = updateSoldeBanque($userid, $paye);
            if ($ok) {
                $products = getCartAll($pdo, 'utilisateurid', $userid);
                foreach ($products as $product) {
                    stockUpdate($product['vehiculeid'], $product['quantite']);
                }
                okCart([$userid, $total]);
                setFlash('success', "paiement effectuer.", generate('facture'));
                echo json_encode(['success' => generate('facture')]);
            } else {
                echo json_encode(['danger' => "nous n'avons pas pu effectuer l'achat, merci de réessayer."]);
            }
        }
    }
}
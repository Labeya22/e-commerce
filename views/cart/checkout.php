<?php

checkUser(generate('user'));

$pdo = DATABASE;

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
            $warning = "il vous reste que {$solde}$ dans votre compte.";
            createNotification([
                'user' => $user['utilisateur_id'],
                'title' => NOTIFICATION['checkout'],
                'content' => $warning
            ]);
            echo json_encode(compact('warning'));
        } else {
    
            $paye = $solde - $total;
            $ok = updateSoldeBanque($userid, $paye);
            if ($ok) {
                $products = getCartAll('utilisateurid', $userid);
                foreach ($products as $product) {
                    stockUpdate($product['vehiculeid'], $product['quantite']);
                }
                okCart([$userid, $total]);
                $success = "paiement effectuer, $total$ a été retirer dans votre compte.";
                createNotification([
                    'user' => $user['utilisateur_id'],
                    'title' => NOTIFICATION['checkout'],
                    'content' => $success
                ]);
                echo json_encode(['success' => generate('facture')]);
            } else {
                echo json_encode(['danger' => "nous n'avons pas pu effectuer l'achat, merci de réessayer."]);
            }
        }
    }
}
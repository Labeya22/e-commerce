<?php






/**
 * @param PDO $pdo
 * @param string $userid
 * 
 * @return int
 */
function  Ncart(PDO $pdo, string $userid): int {
    $req = $pdo->prepare("SELECT COUNT(panier_id)
    FROM paniers WHERE utilisateurid = ?");
    $req->execute([$userid]);
    return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
}

function querySelectCart(int $limit, int $offset) :string {
    return "SELECT p.panier_id, v.vehicule_id,
    v.prix, v.vehicule, mr.marque,
    v.image, s.stock, v.star, p.quantite
    FROM paniers p
    INNER JOIN vehicules v ON v.vehicule_id = p.vehiculeid
    INNER JOIN stocks s ON s.vehiculeid = v.vehicule_id
    INNER JOIN marques mr ON v.marqueid = mr.marque_id
    WHERE p.utilisateurid = :id ORDER BY p.create_at DESC LIMIT $limit OFFSET $offset";
}



/**
 * @param PDO $pdo
 * @param string $userid
 * @param int $limit
 * @param int $page
 * 
 * @return array
 */
function cartPaginer(PDO $pdo, string $userid, int $limit = 12, int $page = 1) :array {

    $count = Ncart($pdo, $userid);
    $pages = ceil($count / $limit);
    $page = $page >= $pages ? $pages : $page;
    $offsetValue = ceil($limit * ($page - 1));
    $offset = $offsetValue < 0 ? 0 : $offsetValue;

    $query = querySelectCart($limit, $offset);
    $req = $pdo->prepare($query);
    $req->execute([':id' => $userid]);

    $pagines = $req->fetchAll();


    return [
        'data' => $pagines,
        'options' => [
            'pages' => $pages,
            'page' => $page
        ]
    ];
}

function getCartJson($user) {
    $pdo = DATABASE;
    $query = "SELECT v.prix, mr.marque, v.vehicule_id, v.vehicule, p.quantite
    FROM paniers p
    INNER JOIN vehicules v ON v.vehicule_id = p.vehiculeid
    INNER JOIN marques mr ON v.marqueid = mr.marque_id
    WHERE p.utilisateurid = ?";
    $req = $pdo->prepare($query);
    $req->execute([$user]);
    return json_encode($req->fetchAll());
}


/**
 * @param PDO $pdo
 * @param string $key
 * @param mixed $value
 * 
 * @return array
 */
function getCart(PDO $pdo, string $key, mixed $value): array {
    $query = "SELECT * FROM paniers WHERE $key = ?";
    $req = $pdo->prepare($query);
    $req->execute([$value]);
    return $req->fetch();
}

function getCartAll(PDO $pdo, string $key, mixed $value): array {
    $query = "SELECT * FROM paniers WHERE $key = ?";
    $req = $pdo->prepare($query);
    $req->execute([$value]);
    return $req->fetchAll();
}



/**
 * @param PDO $pdo
 * @param mixed $userid
 * @param mixed $id
 * 
 * @return bool
 */
function deleteCart(PDO $pdo, mixed $userid, mixed $id): bool {
    $query = "DELETE FROM paniers WHERE utilisateurid = ? AND panier_id = ?";
    $req = $pdo->prepare($query);
    return $req->execute([$userid, $id]);
}


function addCart(PDO $pdo, array $options): array {
    $product = $options['product'];
    $user = $options['user'];
    $queryExist = "SELECT * FROM paniers WHERE  utilisateurid = ? AND vehiculeid = ?";
    $req = $pdo->prepare($queryExist);
    $req->execute([$user, $product]);
    $exist = $req->fetch();


    if (empty($exist)) {
        $query = "INSERT INTO paniers SET utilisateurid = ? , vehiculeid = ?, create_at = NOW()";
        $req = $pdo->prepare($query);
        $ok = $req->execute([$user, $product]);
        return ['query' => 'INSERT', 'ok' => $ok];

    } else {
        $query = "UPDATE paniers SET create_at = NOW() WHERE panier_id = ?";
        $req = $pdo->prepare($query);
        $ok = $req->execute([$exist['panier_id']]);
        return ['query' => 'UPDATE', 'ok' => $ok];
    }
}

function getPanier(PDO $pdo, $vehicule, $user): array {
    $query = "SELECT * FROM paniers WHERE utilisateurid = ? AND vehiculeid = ?";
    $req = $pdo->prepare($query);
    $req->execute([$user, $vehicule]);
    $fetch = $req->fetch();
    return $fetch === false ? [] : $fetch;
}

function hasPanier(PDO $pdo, $vehicule, $user): bool {
    $fetch = getPanier($pdo, $vehicule, $user);
    return !empty($fetch);
}

function changeQuantity(PDO $pdo, $cart, $quantity): bool {
    if ($cart['quantite'] !== $quantity) {
        $query = "UPDATE paniers SET quantite = ? WHERE panier_id = ?";
        $req = $pdo->prepare($query);
        return $req->execute([$quantity, $cart['panier_id']]);
    }

    return false;
}

function okCart($data) {
    $pdo = DATABASE;
    list($user, $total) = $data;
    $cart = getCartJson($user);
    $create = createFacture([$cart, $total, $user]);
    if ($create) {
        return deleteCartAll($user);
    }

    return false;
}

function deleteCartAll($user) {
    $pdo = DATABASE;
    $query = "DELETE FROM paniers WHERE utilisateurid = ?";
    $req = $pdo->prepare($query);
    return $req->execute([$user]);
}
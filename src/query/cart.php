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
    WHERE p.utilisateurid = :id LIMIT $limit OFFSET $offset";
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
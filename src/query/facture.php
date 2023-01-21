<?php



function createFacture(array $data)  {
    /**
     * @var PDO
     */
    $pdo = DATABASE;
    $generateid = generateToken(6);
    $query = "INSERT INTO factures SET cart = ?, total = ?, utilisateurid = ?, facture_id = ?, create_at = NOW()";
    $req = $pdo->prepare($query);
    $data[] = $generateid;
    return $req->execute($data);
}

function getFacture($user)  {
    /**
     * @var PDO
     */
    $pdo = DATABASE;
    $query = "SELECT 
    fac.cart, fac.create_at, fac.total, fac.facture_id,
    u.nom, u.prenom, u.email, u.utilisateur, b.numberAccount
    FROM factures fac
    INNER JOIN utilisateurs u ON u.utilisateur_id = fac.utilisateurid
    INNER JOIN banques b ON fac.utilisateurid = b.utilisateurid
    WHERE fac.utilisateurid = ? ORDER BY fac.create_at DESC";
    $req = $pdo->prepare($query);
    $req->execute([$user]);
    return $req->fetch();
}

function getFactureAll($user)  {
    $pdo = DATABASE;
    $query = "SELECT * FROM factures WHERE utilisateurid = ? ORDER BY create_at DESC";
    $req = $pdo->prepare($query);
    $req->execute([$user]);
    return $req->fetchAll();
}

function getFactureEye(array $data) {
    $pdo = DATABASE;
    $query = "SELECT 
    fac.cart, fac.create_at, fac.total, fac.facture_id,
    u.nom, u.prenom, u.email, u.utilisateur, b.numberAccount
    FROM factures fac
    INNER JOIN utilisateurs u ON u.utilisateur_id = fac.utilisateurid
    INNER JOIN banques b ON fac.utilisateurid = b.utilisateurid
    WHERE fac.utilisateurid = ? AND fac.facture_id = ?";
    $req = $pdo->prepare($query);
    $req->execute($data);
    $fetch = $req->fetch();
    return $fetch === false ? [] : $fetch;
}

function  Nfacture(string $userid): int {
    $pdo = DATABASE;
    $req = $pdo->prepare("SELECT COUNT(facture_id)
    FROM factures WHERE utilisateurid = ?");
    $req->execute([$userid]);
    return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
}

function getFacturesPaginer($userid, $page = 1, $limit = 24): array {
    $pdo = DATABASE;
    $count = Nfacture($userid);
    $pages = ceil($count / $limit);
    $page = $page >= $pages ? $pages : $page;
    $offsetValue = ceil($limit * ($page - 1));
    $offset = $offsetValue < 0 ? 0 : $offsetValue;

    $query = "SELECT * 
    FROM factures 
    WHERE utilisateurid = ? 
    ORDER BY create_at DESC 
    LIMIT $limit OFFSET $offset";
    $req = $pdo->prepare($query);
    $req->execute([$userid]);

    $pagines = $req->fetchAll();


    return [
        'data' => $pagines,
        'options' => [
            'pages' => $pages,
            'page' => $page
        ]
    ];
}

function getFactures() {
    $pdo = DATABASE;
    $req = $pdo->query("SELECT * FROM factures");
    $data = $req->fetchAll();
    if ($data === false || empty($data)) return 0;
    $total = 0;
    foreach ($data as $d) {
        $total += $d['total'];
    }
    return $total;
}
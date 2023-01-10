<?php

/**
 * Permet de lister les vehicules
 * 
 * @param PDO $pdo
 * @param boolean $paginate
 * @return array
 */
function listingVehicules(PDO $pdo): array {
    $query = " SELECT 
    v.vehicule_id, v.prix, v.vehicule, 
    v.promo, v.image, m.marque, p.auto, p.carburant,
    p.kilometrage
    FROM vehicules v
    INNER JOIN marques m ON m.marque_id = v.marqueid
    INNER JOIN parametres p ON p.vehiculeid = v.vehicule_id
    ";
    
    $req = $pdo->query($query);
    return $req->fetchAll();
}

function whereString(array $array) {
    return  'WHERE ' .  '(' . implode(') AND (', $array) . ')';
}

/**
 * Permet de filtré les résultats
 *
 * @return array|string
 */
function filter(): array|string {
    $query = [];
    $prepare = [];

    // pour le recherche
    if (hasQueryParams('q')) {
        $search = getQueryParamsString('q');
        $query[] = "v.vehicule LIKE '%$search%'";
    }

    // pour le type de voiture
    if (hasQueryParams('type')) {
        $type = getQueryParamsString('type');
        $query[] = "t.type = :type";
        $prepare[':type'] = $type;
    }

    // pour le marque
    if (hasQueryParams('marque')) {
        $marque = getQueryParamsString('marque');
        $query[] = "m.marque = :marque";
        $prepare[':marque'] = $marque;
    }

    //  pour le promo
    if (hasQueryParams('promo')) {
        $promo = getQueryParamsString('promo');
        $query[] = "v.promo = :promo";
        $prepare[':promo'] = 1;
    }

    return empty($query) ? '' : [whereString($query), $prepare];
}

/**
 * Permet de compter les nombres total de vehicules 
 *
 * @param PDO $pdo
 * @return integer
 */
function  Nproduct(PDO $pdo): int {
    $filter = filter();

    if (is_array($filter)) {
        list($filterQuery, $execute) = $filter;
        $req = $pdo->prepare("
        SELECT COUNT(v.vehicule_id)
        FROM vehicules v
        INNER JOIN marques m ON m.marque_id = v.marqueid
        INNER JOIN types t ON t.type_id = v.typeid
        {$filterQuery}
        ");
        $req->execute($execute);
        return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
    }

    list($filterQuery, $execute) = filter();
    $req = $pdo->query("SELECT COUNT(vehicule_id) FROM vehicules");
    return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
}

function querySelectVehicule(int $limit, int $offset, $filter = '') :string {
    return " 
    SELECT 
    v.vehicule_id, v.prix, v.vehicule, 
    v.promo, v.image, m.marque, p.auto, p.carburant,
    p.kilometrage
    FROM vehicules v
    INNER JOIN marques m ON m.marque_id = v.marqueid
    INNER JOIN parametres p ON p.vehiculeid = v.vehicule_id 
    INNER JOIN types t ON t.type_id = v.typeid
    {$filter}  LIMIT $limit OFFSET $offset
    ";
}

/**
 * Permet de lister les vehicules + paginer les résultat
 *
 * @param PDO $pdo
 * @param integer $limit
 * @param integer $page
 * @return array
 */
function VehiculesPaginer(PDO $pdo, $limit = 12, $page = 1) :array {

    $count = Nproduct($pdo);
    $pages = ceil($count / $limit);
    $page = $page >= $pages ? $pages : $page;
    $offsetValue = ceil($limit * ($page - 1));
    $offset = $offsetValue < 0 ? 0 : $offsetValue;
    $filter = filter();

    if (is_string($filter)) {
        $query = querySelectVehicule($limit, $offset);
        $pagines = ($pdo->query($query))->fetchAll();

    } else {
        list($filterQuery, $execute) = $filter;
        $query = querySelectVehicule($limit, $offset, $filterQuery);
        $req = $pdo->prepare($query);
        $req->execute($execute);
        $pagines = $req->fetchAll();
    }

    return [
        'data' => $pagines,
        'options' => [
            'pages' => $pages,
            'page' => $page
        ]
    ];
}


function getMedia(PDO $pdo, $id) {
    $query = "SELECT * FROM medias WHERE vehiculeid = ?";
    $req = $pdo->prepare($query);
    $req->execute([$id]);
    return $req->fetchAll();
}

function voirVehicule(PDO $pdo, string $id): array {

    $query = "    SELECT 
    v.vehicule_id, v.prix, v.vehicule, 
    v.promo, v.image, m.marque, p.auto, p.carburant,
    p.kilometrage, v.description
    FROM vehicules v
    INNER JOIN marques m ON m.marque_id = v.marqueid
    INNER JOIN parametres p ON p.vehiculeid = v.vehicule_id 
    INNER JOIN types t ON t.type_id = v.typeid
    WHERE v.vehicule_id = ?
    ";
    $req = $pdo->prepare($query);
    $req->execute([$id]);
    $product = $req->fetch();
    if (empty($product)) {
        throw new Exception("nous n'avons pas pu trouver le vehicule #$id");
    }

    $medias = getMedia($pdo, $product['vehicule_id']);

    return [
        'product' => $product,
        'media' => $medias
    ];

}
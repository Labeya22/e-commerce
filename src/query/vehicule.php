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
    v.vehicule_id, v.prix, v.vehicule, v.star,
    v.promo, v.image, m.marque, p.auto, p.carburant,
    p.kilometrage, t.type, v.create_at
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
 * @param int $page
 * @param int $limit
 * @param string|null $search
 * 
 * @return array
 */
function getVehiculesPaginer($page = 1, $limit = 12, ?string $search = null) :array {

    $pdo = DATABASE;
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


/**
 * @param PDO $pdo
 * @param mixed $id
 * 
 * @return array
 */
function getMedia(PDO $pdo, mixed $id): array {
    $query = "SELECT * FROM medias WHERE vehiculeid = ?";
    $req = $pdo->prepare($query);
    $req->execute([$id]);
    return $req->fetchAll();
}

/**
 * @param PDO $pdo
 * @param string $id
 * 
 * @return array
 */
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


/**
 * @param string $key
 * @param mixed $value
 * 
 * @return array
 */
function getVehicule(string $key, mixed $value): array {
    $pdo = DATABASE;
    $query = "SELECT * FROM vehicules WHERE $key = ?";
    $req = $pdo->prepare($query);
    $req->execute([$value]);
    $fetch =  $req->fetch();
    return $fetch === false ? [] : $fetch;
}


function getResultatSearchVehicules() {
    if (empty($search) || is_null($search)) return null;
    $pdo = DATABASE;
    $query = "SELECT COUNT(vehicule_id) FROM vehicules WHERE vehicule LIKE '%$search%'";
    $req = $pdo->query($query);
    $resultat = $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
    return $resultat;
}


/**
 * @param string $value
 * 
 * @return bool
 */
function deleteVehicule(string $value): bool {
    $pdo = DATABASE;
    $exist = getVehicule($pdo, 'vehicule_id', $value);
    if (empty($exist)) return false;
    $req = $pdo->prepare("DELETE FROM vehicules WHERE vehicule_id = ?");
    return $req->execute([$exist['vehicule_id']]);
}

/**
 * @param string $field
 * @param string $value
 * 
 * @return bool
 */
function hasVehicule(string $field, string $value, ?string $update = null): bool {
    return !empty(getVehicule($field, $value));
}

function createVehicule($data) {
    $pdo = DATABASE;
    $req = $pdo->prepare("INSERT INTO vehicules 
    SET vehicule_id = :id typeid = :typeid, marqueid = :marqueid,
    promo = :promo, image = :image,
    star = :star, vehicule = :vehicule, description = :desc
    create_at = NOW()");
    return $req->execute([
        ':id' => generateToken(60),
        ':vehicule' => $data['vehicule'],
        ':typeid' => $data['typeid'],
        ':marqueid' => $data['marque'],
        ':star' => $data['star'],
        ':promotion' => $data['promotion'],
        ':image' => $data['image'],
        ':description' => $data['desc'],
    ]);
}

function updateVehicule(array $data) {
    $pdo = DATABASE;
    $req = $pdo->prepare("UPDATE types SET type = ?, create_at = NOW() WHERE type_id = ?");
    return $req->execute($data);
}

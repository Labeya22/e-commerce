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
 * @param int $page
 * @param int $limit
 * @param string|null $search
 * 
 * @return array
 */
function getVehiculePaginer(int $page, int $limit = 12, ?string $search = null): array
{  
    $pdo = DATABASE;
    $count = NVehicule($search);
    $pages = ceil($count / $limit);
    $page = $page >= $pages ? $pages : $page;
    $offsetValue = ceil($limit * ($page - 1));
    $offset = $offsetValue < 0 ? 0 : $offsetValue;
    $query = getQueryPagine($limit, $offset, $search);
    $req = $pdo->query($query);
    $fetch = $req->fetchAll();
    return [
        'data' => $fetch,
        'options' => [
            'pages' => $pages,
            'page' => $page
        ]
    ];
}


/**
 * @param int $limit
 * @param int $offset
 * @param string|null $search
 * 
 * @return string
 */
function getQueryPagine(int $limit, int $offset, ?string $search = null): string {
    if (is_null($search) || empty($search)) {
        $query = "SELECT v.vehicule_id, v.prix, v.vehicule, v.star,
        v.promo, v.image, m.marque, t.type, v.create_at FROM vehicules v
        INNER JOIN marques m ON m.marque_id = v.marqueid
        INNER JOIN types t ON t.type_id = v.typeid LIMIT $limit OFFSET $offset";
    } else {
        $query = "SELECT v.vehicule_id, v.prix, v.vehicule, v.star,
        v.promo, v.image, m.marque, t.type, v.create_at
        FROM vehicules v INNER JOIN marques m ON m.marque_id = v.marqueid
        INNER JOIN types t ON t.type_id = v.typeid
        WHERE (v.vehicule LIKE '%$search%') OR (m.marque LIKE '%$search%') OR 
        (t.type LIKE '%$search%')  LIMIT $limit OFFSET $offset";
    }

    return $query;
}

function NVehicule(?string $search = null) {
    $pdo = DATABASE;
    if (is_null($search) || empty($search)) {
        $req = $pdo->query("SELECT COUNT(v.vehicule_id)
        FROM vehicules v INNER JOIN marques m ON m.marque_id = v.marqueid
        INNER JOIN types t ON t.type_id = v.typeid");
    } else {
        $req = $pdo->query("SELECT COUNT(v.vehicule_id)
        FROM vehicules v INNER JOIN marques m ON m.marque_id = v.marqueid
        INNER JOIN types t ON t.type_id = v.typeid 
        WHERE (v.vehicule LIKE '%$search%') OR 
        (m.marque LIKE '%$search%') OR (t.type LIKE '%$search%')   ");
    }
    return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
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
function getEyeVehicule(string $id): array {
    $pdo = DATABASE;
    $query = "    SELECT 
    v.vehicule_id, v.prix, v.vehicule, 
    v.promo, v.image, m.marque, p.auto, p.carburant,
    p.kilometrage, v.description, t.type
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

   return $product;

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


function getResultatSearchVehicules($search) {
    if (empty($search) || is_null($search)) return null;
    $pdo = DATABASE;
    $query = "SELECT COUNT(v.vehicule_id) FROM vehicules v
    INNER JOIN marques m ON m.marque_id = v.marqueid
    INNER JOIN types t ON t.type_id = v.typeid
    WHERE (v.vehicule LIKE '%$search%') OR 
        (m.marque LIKE '%$search%') OR (t.type LIKE '%$search%')";
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
        SET vehicule_id = :id, typeid = :typeid, marqueid = :marqueid,
        promo = :promo, image = :image, prix = :prix,
        star = :star, vehicule = :vehicule, description = :desc,create_at = NOW()"
    );
    $generatId = generateToken(60);
    $create =  $req->execute([
        ':id' => $generatId,
        ':vehicule' => $data['vehicule'],
        ':typeid' => $data['type'],
        ':marqueid' => $data['marque'],
        ':star' => $data['star'],
        ':promo' => $data['promotion'],
        ':prix' => $data['prix'],
        ':image' => $data['image'],
        ':desc' => $data['desc'],
    ]);
    if ($create) {
        createSock($generatId, $data['stock']);
        createParameters($generatId, $data);
    }

    return $create;
}

function updateVehicule(array $data) {
    $pdo = DATABASE;
    $req = $pdo->prepare("UPDATE types SET type = ?, create_at = NOW() WHERE type_id = ?");
    return $req->execute($data);
}

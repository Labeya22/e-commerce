<?php

/**
 * Permet lister les marques
 *
 * @param PDO $pdo
 * @return array
 */
function listingMarques(PDO $pdo): array {
    $req = $pdo->query("SELECT * FROM marques");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}


function NMarque(PDO $pdo, $search = null) {
    $like = is_null($search) ? '' : "WHERE marque LIKE '%$search%' ";
    $req = $pdo->query("SELECT COUNT('marque_id')FROM marques $like");
    return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
}

function getMarquePagine(int $limit = 12, int $page = 1, ?string $search = null) : array {
    $pdo = DATABASE;
    $count = NMarque($pdo, $search);
    $pages = ceil($count / $limit);
    $page = $page >= $pages ? $pages : $page;
    $offsetValue = ceil($limit * ($page - 1));
    $offset = $offsetValue < 0 ? 0 : $offsetValue;

    if (is_null($search)) {
        $query = "SELECT * FROM marques LIMIT $limit OFFSET $offset";
    } else  {
        $query = "SELECT * FROM marques WHERE marque LIKE '%$search%' LIMIT $limit OFFSET $offset";
    }
    
    $req = $pdo->query($query);
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
 * @param string $value
 * @param string $field
 * 
 * @return array
 */
function getMarque(string $value, string $field = 'marque_id', $update = null): array {
    $pdo = DATABASE;
    $query = "SELECT * FROM marques WHERE $field = ?";
    if (!is_null($update)) $query .=  "AND marque_id != $update";
    $req = $pdo->prepare($query);
    $req->execute([$value]);
    $fetch = $req->fetch();
    return $fetch === false ? [] : $fetch;
}

/**
 * @param string $value
 * 
 * @return bool
 */
function deleteMarque(string $value): bool {
    $exist = getMarque($value);
    if (empty($exist)) return false;
    $pdo = DATABASE;
    $req = $pdo->prepare("DELETE FROM types WHERE type_id = ?");
    return $req->execute([$exist['marque_id']]);
}

/**
 * @param string $field
 * @param string $value
 * 
 * @return bool
 */
function hasMarque(string $field, string $value, ?string $update = null): bool {
    return !empty(getMarque($value, $field, $update));
}

/**
 * @param string $marque
 * 
 * @return bool
 */
function createMarque(string $marque): bool {
    $id = generateToken(60);
    $pdo = DATABASE;
    $req = $pdo->prepare("INSERT INTO marques SET marque_id = ?, marque = ?, create_at = NOW()");
    return $req->execute([$id, $marque]);
}

/**
 * @param array $data
 * 
 * @return bool
 */
function updateMarque(array $data): bool {
    $pdo = DATABASE;
    $req = $pdo->prepare("UPDATE marques SET marque = ?, create_at = NOW() WHERE marque_id = ?");
    return $req->execute($data);
}

/**
 * @param string|null $search
 * 
 * @return int|null
 */
function getResultatSearchMarque(?string $search = null): ?int {
    if (empty($search) || is_null($search)) return null;
    $pdo = DATABASE;
    $query = "SELECT COUNT(marque_id) FROM marques WHERE marque LIKE '%$search%'";
    $req = $pdo->query($query);
    $resultat = $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
    return $resultat;
}
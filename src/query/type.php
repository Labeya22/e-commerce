<?php

/**
 * Listing de tous les categories
 *
 * @return array
 */
function listingTypes(PDO $pdo): array {
    $req = $pdo->query("SELECT * FROM types");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function NTypes($search = null) {
    $pdo = DATABASE;
    $like = is_null($search) ? '' : "WHERE type LIKE '%$search%' ";
    $req = $pdo->query("SELECT COUNT('type_id')FROM types $like");
    return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
}

function getTypePagine(int $limit = 12, int $page = 1, ?string $search = null) : array {
    $pdo = DATABASE;
    $count = NTypes($search);
    $pages = ceil($count / $limit);
    $page = $page >= $pages ? $pages : $page;
    $offsetValue = ceil($limit * ($page - 1));
    $offset = $offsetValue < 0 ? 0 : $offsetValue;

    if (is_null($search)) {
        $query = "SELECT * FROM types LIMIT $limit OFFSET $offset";
    } else  {
        $query = "SELECT * FROM types WHERE type LIKE '%$search%' LIMIT $limit OFFSET $offset";
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
function getTypes(string $value, string $field = 'type_id'): array {
    $pdo = DATABASE;
    $req = $pdo->prepare("SELECT * FROM types WHERE $field = ?");
    $req->execute([$value]);
    $fetch = $req->fetch();

    return $fetch === false ? [] : $fetch;
}

/**
 * @param string $value
 * 
 * @return bool
 */
function deleteType(string $value): bool {
    $exist = getTypes($value);
    if (empty($exist)) return false;
    $pdo = DATABASE;
    $req = $pdo->prepare("DELETE FROM types WHERE type_id = ?");
    return $req->execute([$exist['type_id']]);
}

/**
 * @param string $field
 * @param string $value
 * 
 * @return bool
 */
function hasType(string $field, string $value, ?string $update = null): bool {
    $pdo = DATABASE;
    if (is_null($update)) {
        $req = $pdo->prepare("SELECT * FROM types WHERE $field = ?");
        $req->execute([$value]);
    } else {
        $req = $pdo->prepare("SELECT * FROM types WHERE $field = ? AND type_id != ?");
        $req->execute([$value, $update]);
    }
    
    return !empty($req->fetch());
}

function createType($type) {
    $id = generateToken(60);
    $pdo = DATABASE;
    $req = $pdo->prepare("INSERT INTO types SET type_id = ?, type = ?, create_at = NOW()");
    return $req->execute([$id, $type]);
}

function updateType(array $data) {
    $pdo = DATABASE;
    list($type, $id) = $data;
    $req = $pdo->prepare("UPDATE types SET type = :t, create_at = NOW() WHERE type_id = :id");
    return $req->execute([':t' => $type, ':id' => $id]);
}

function getNResultatSearch($search): ?int {
    if (empty($search) || is_null($search)) return null;
    $pdo = DATABASE;
    $query = "SELECT COUNT(type_id) FROM types WHERE type LIKE '%$search%'";
    $req = $pdo->query($query);
    $resultat = $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
    return $resultat;
}
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

function NTypes(PDO $pdo) {
    $req = $pdo->query("SELECT COUNT('type_id') FROM types");
    return $req->fetch(PDO::FETCH_NUM)[0] ?? 0;
}

function getTypePagine(int $limit = 12, int $page = 1, ?string $search = null) : array {
    $pdo = DATABASE;
    $count = NTypes($pdo);
    $pages = ceil($count / $limit);
    $page = $page >= $pages ? $pages : $page;
    $offsetValue = ceil($limit * ($page - 1));
    $offset = $offsetValue < 0 ? 0 : $offsetValue;

    $query = "SELECT * FROM types LIMIT $limit OFFSET $offset";
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
    return $req->fetch();
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
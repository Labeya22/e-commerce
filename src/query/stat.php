<?php

/**
 * @param string $id
 * @param string $month
 * @param string $year
 * 
 * @return int
 */
function getStat(string $id, string $month, string $year): int {
    $pdo = DATABASE;
    $req = $pdo->prepare("SELECT * FROM stats WHERE vehiculeid = ? AND createat LIKE '%$year-$month%'");
    $req->execute([$id]);
    $data = $req->fetchAll();
    if ($data === false || empty($data)) return 0;
    $stats = 0;
    foreach ($data as $stat) {
        $stats += $stat['stat'];
    }

    return $stats;
}

function createStat(string $vehicule) {
    $pdo = DATABASE;
    $generateId = generateToken(60);
    $req = $pdo->prepare("INSERT INTO stats SET stat_id = ?, vehiculeid = ?, createat = NOW()");
    return $req->execute([$generateId, $vehicule]);
}
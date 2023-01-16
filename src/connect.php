<?php

/**
 * Connexion à la base de données
 *
 * @return PDO
 */
function getPDO(): PDO
{
    $dbname = "ecommercevehicules";
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";

    try {
        return new PDO("mysql:dbname=$dbname;host=$host", $user, $pass, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (\Throwable $th) {
        echo "nous n'avons pas pu se connecter à la base de données (ref: {$th->getMessage()})";
    }
}
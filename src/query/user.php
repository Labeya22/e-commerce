<?php

function hasFieldOrField($value, ...$fields) {
    $field = implode(' OR ', array_map(function ($field) {
        return "$field = :field";
    }, $fields));
    $pdo = getPDO();

    $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field");
    $req->execute([':field' => $value]);
    $fetch = $req->fetch();
    
    return $fetch === false;
}

function hasFieldUser($field, $value , $id = null) {
    $pdo = getPDO();
    if (!is_null($id)) {
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field = ? AND utilisateur_id != $id");
        $req->execute([$value]);
        return !empty($req->fetch());
    }
    $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field = ?");
    $req->execute([$value]);
    return !empty($req->fetch());

}


function createUser(PDO $pdo, array $data, $code): bool
{
    $query = "INSERT INTO utilisateurs SET utilisateur_id = :id, nom = :nom, prenom = :prenom ,
    utilisateur = :utilisateur, token = :token, code = :code,
    email = :email, password = :password,
    create_at = NOW()";
    return $pdo->prepare($query)->execute([
        ':id' => generateToken(60),
        ':nom' => $data['nom'],
        ':prenom' => $data['prenom'],
        ':utilisateur' => $data['utilisateur'],
        ':email' => $data['email'],
        ':token' => generateToken(60),
        ':code' => $code,
        ':password' => hashPass($data['password']),
    ]);
}

function getUser($pdo, $key, $value) {
    $query = "SELECT * FROM utilisateurs WHERE $key = ?";
    $req = $pdo->prepare($query);
    $req->execute([$value]);
    return $req->fetch();
}

function getUserFieldOrField($value, ...$fields) {
    $field = implode(' OR ', array_map(function ($field) {
        return "$field = :field";
    }, $fields));
    $pdo = getPDO();

    $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE $field");
    $req->execute([':field' => $value]);
    $fetch = $req->fetch();
    
    return $fetch === false ? [] : $fetch;
}

function confirmUser($pdo, $id) {
    $query = "UPDATE utilisateurs SET 
    isconfirm = 1, code = NULL, 
    confirm_at = NOW(), token = NULL
    WHERE utilisateur_id = ? ";
    return $pdo->prepare($query)->execute([$id]);
}

function editUser(PDO $pdo, array $data, string $id) {
    $query = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom , email = :email,
    utilisateur = :utilisateur, update_at = NOW() WHERE utilisateur_id = :id";
    return $pdo->prepare($query)->execute([
        ':nom' => $data['nom'],
        ':prenom' => $data['prenom'],
        ':utilisateur' => $data['utilisateur'],
        ':email' => $data['email'],
        ':id' => $id,
    ]);
}


function changePasswordUser(PDO $pdo, array $data, string $id) {
    $query = "UPDATE utilisateurs SET password = :password, update_at = NOW() WHERE utilisateur_id = :id";
    return $pdo->prepare($query)->execute([
        ':password' => hashPass($data['password']),
        ':id' => $id
    ]);
}


function deleteUser(PDO $pdo, $id) {
    $user = getUser($pdo, 'utilisateur_id', $id);
    if (!empty($user)) {
        $query = "DELETE FROM utilisateurs WHERE utilisateur_id = ?";
        return $pdo->prepare($query)->execute([$user['utilisateur_id']]);
    }

    return false;
 
}


function userYourMail(PDO $pdo, $email) {
    $user = getUser($pdo, 'email', $email);

    if (!empty($user)) {
        $code = generateToken(8);
        $query = "UPDATE utilisateurs SET code = :code, expirate = NOW() WHERE utilisateur_id = :id";
        $send =  $pdo->prepare($query)->execute([
            ':code' => $code,
            ':id' => $user['utilisateur_id']
        ]);

        return !$send ? null : [$code, $user];
    }

    return null;
}

function userCodeResetOk (PDO $pdo, $id, $token) {
    $query = "UPDATE utilisateurs SET  code = NULL, 
    expirate = NULL, token = :token
    WHERE utilisateur_id = :id ";
    return $pdo->prepare($query)->execute([
        ':token' => $token,
        ':id' => $id
    ]);
}


function expirate($pdo) {

}
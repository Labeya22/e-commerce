<?php

function getErrorVehicule(array $data): array{
    $errors = [];

    if (empty($data)) return $errors;

    if (empty($data['vehicule'])) {
        $errors['vehicule'] = "est obligatoire.";
    } else {
        $vehicule = $data['vehicule'];
        $regex = regex($vehicule, "/^[-_'a-z0-9A-ZÀ-ÖØ-öø-ÿ ]+$/");
        if (!$regex) {
            $errors['vehicule'] = "contient des caractères invalide."; 
        } else {
            $has = hasVehicule('vehicule', $vehicule);
            if ($has) {
                $errors['vehicule'] = "est utilisé."; 
            }
        }
    }

    if (empty($data['type'])) {
        $errors['type'] = "est obligatoire.";
    }

    if (empty($data['marque'])) {
        $errors['marque'] = "est obligatoire.";
    }

    if (empty($data['star'])) {
        $errors['star'] = "est obligatoire.";
    }

    if (empty($data['promotion'])) {
        $errors['promotion'] = "est obligatoire.";
    }

    if (empty($data['carburant'])) {
        $errors['carburant'] = "est obligatoire.";
    }

    if (empty($data['stock'])) {
        $errors['stock'] = "est obligatoire.";
    } else {
        $stock = $data['stock'];
        $regex = regex($stock, "/^[0-9]/");
        if (!$regex) {
            $errors['stock'] = "contient des caractères invalide."; 
        }
    }

    if (empty($data['desc'])) {
        $errors['desc'] = "est obligatoire.";
    }

    return $errors;
}

function getErrorVehiculeUploadImage($data) {
    $extensions = ['jpg', 'svg', 'jpeg', 'png', 'gif'];
    $errors = [];

    if (!empty($data)) {
        $file = $data['name'] ?? "";
        if ($data['error'] != 0 || empty($file)) {
            $errors['errors'] = "ce champs est obligatoire.";
        } else {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if (!in_array($extension, $extensions)) {
                $errors['errors'] = "uploadé une image";
            }
        }
    }

  

    return $errors;
}
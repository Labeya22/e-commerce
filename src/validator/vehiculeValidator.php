<?php

function getErrorVehicule(array $data): array{
    $errors = [];

    if (!empty($data) && !empty($data['uploader'])) {
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

        if (empty($data['kilometrage'])) {
            $errors['kilometrage'] = "est obligatoire.";
        }

        if (empty($data['transmission'])) {
            $errors['transmission'] = "est obligatoire.";
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

        if (empty($data['prix'])) {
            $errors['prix'] = "est obligatoire.";
        } else {
            $prix = $data['prix'];
            $regex = regex($prix, "/^[0-9]/");
            if (!$regex) {
                $errors['prix'] = "contient des caractères invalide."; 
            }
        }

        if (empty($data['uploader'])) {
            $errors['uploader'] = "est obligatoire.";
        } else {
            $file = $data['uploader'];
            $filename = $file['name'];
            if ($file['error'] != 0 || empty($filename)) {
                $errors['uploader'] = "uploadé une image";
            } else {
                $extensions = ['jpg', 'svg', 'jpeg', 'png', 'gif'];
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($extension, $extensions)) {
                    $errors['uploader'] = "uploadé une image";
                }
            }
        }

        if (empty($data['desc'])) {
            $errors['desc'] = "est obligatoire.";
        }
    }

    return $errors;
}

function getErrorVehiculeUpdate(array $data, array $file,  string $id): array{
    $errors = [];

    if (!empty($data)) {
        if (empty($data['vehicule'])) {
            $errors['vehicule'] = "est obligatoire.";
        } else {
            $vehicule = $data['vehicule'];
            $regex = regex($vehicule, "/^[-_'a-z0-9A-ZÀ-ÖØ-öø-ÿ ]+$/");
            if (!$regex) {
                $errors['vehicule'] = "contient des caractères invalide."; 
            } else {
                $has = hasVehicule('vehicule', $vehicule, $id);
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

        if (empty($data['kilometrage'])) {
            $errors['kilometrage'] = "est obligatoire.";
        }

        if (empty($data['transmission'])) {
            $errors['transmission'] = "est obligatoire.";
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

        if (empty($data['prix'])) {
            $errors['prix'] = "est obligatoire.";
        } else {
            $prix = $data['prix'];
            $regex = regex($prix, "/^[0-9]/");
            if (!$regex) {
                $errors['prix'] = "contient des caractères invalide."; 
            }
        }


        if (!empty($file['name'])) {
            $filename = $file['name'];
            if ($file['error'] != 0 || empty($filename)) {
                $errors['uploader'] = "uploadé une image";
            } else {
                $extensions = ['jpg', 'svg', 'jpeg', 'png', 'gif'];
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($extension, $extensions)) {
                    $errors['uploader'] = "uploadé une image";
                }
            }
        }

        if (empty($data['desc'])) {
            $errors['desc'] = "est obligatoire.";
        }
    }

    return $errors;
}
<?php

/**
 * @param array $data
 * 
 * @return array
 */
function getErrorsMarque(array $data, $update = null): array {
    $errors = [];
    if (!empty($data)) {
        if (empty($data['marque'])) {
            $errors['marque'] = "est obigatoire.";
        } else {
            $marque = $data['marque'];
            $regex = regex($marque, "/^[-_'a-z0-9A-ZÀ-ÖØ-öø-ÿ ]+$/");
            if (!$regex) {
                $errors['marque'] = "contient des caractères invalide."; 
            } else {
                $has = hasMarque('marque', $marque, $update);
                if ($has) {
                    $errors['marque'] = "est utilisé."; 
                }
            }
        }
    }

    return $errors;
}
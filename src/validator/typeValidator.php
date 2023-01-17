<?php

/**
 * @param array $data
 * 
 * @return array
 */
function getErrorsType(array $data, $update = null): array {
    $errors = [];
    if (!empty($data)) {
        if (empty($data['type'])) {
            $errors['type'] = "est obigatoire.";
        } else {
            $type = $data['type'];
            $regex = regex($type, "/^[-_'a-z0-9A-ZÀ-ÖØ-öø-ÿ ]+$/");
            if (!$regex) {
                $errors['type'] = "contient des caractères invalide."; 
            } else {
                $has = hasType('type', $type, $update);
                if ($has) {
                    $errors['type'] = "est utilisé."; 
                }
            }
        }
    }

    return $errors;
}
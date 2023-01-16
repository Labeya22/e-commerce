<?php

function getErrorCheckout($data, $userid): array {
    $errors = [];
    if (!empty($data)) {
        if (empty($data['secret'])) {
            $errors['secret'] = "est obligatoire.";
        } else {
            $secret = $data['secret'];
            $secretRegex = regex($secret, "(^[0-9a-zA-Z]+$)");
            if (!$secretRegex) {
                $errors['secret'] = "contient des caractères invalides.";
            } else {
                $secretEqual = isEqual($secret, 6);
                if (!$secretEqual) {
                    $errors['secret'] = "doit avoir 6 caractères.";
                }
            }
        }

        if (empty($data['account'])) {
            $errors['account'] = "est obligatoire.";
        } else {
            $account = $data['account'];
            $accountRegex = regex($account, "(^[0-9]+$)");
            if (!$accountRegex) {
                $errors['account'] = "contient des caractères invalides.";
            } else {
                $accountEqual = isEqual(strlen($account), 8);
                if (!$accountEqual) {
                    $errors['account'] = "doit avoir 8 chiffres.";
                } else {
                    $hasAccount = hasNumberAccount($account, $userid);
                    if (!$hasAccount) {
                        $errors['account'] = "aucun compte associé à ce numéro.";   
                    } else {
                        $hasSecret = hasSecret($secret, $account,  $userid);
                        if (!$hasSecret) {
                            $errors['secret'] = "le code secret est incorrect valide";   
                        }
                    }
                }
            }
        }
    }



    return $errors;
}
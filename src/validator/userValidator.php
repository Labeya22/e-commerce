<?php


function getErrorUser($data) {
    $errors = [];

    if (!empty($data)) {
        if (empty($data['nom'])) {
            $errors['nom'] = "Le champs nom est requis.";
        } else {
            $nom = $data['nom'];
            $lenghtBetweenNom = lenghtBetween($nom, 3, 255);
            if ($lenghtBetweenNom) {
                $errors['nom'] = "doit contenir entre 3 à 255 caractères";
            } else {
                $regexNom = regex($nom, "(^[0-9a-zA-Zçéèâôîû_]+$)");
                if (!$regexNom) {
                    $errors['nom'] = "contient des caractères invalide.";
                }
            }
        }

        if (empty($data['prenom'])) {
            $errors['prenom'] = "Le champs prénom est requis.";
        } else {
            $prenom = $data['prenom'];
            $lenghtBetweenPrenom = lenghtBetween($prenom, 3, 255);
            if ($lenghtBetweenPrenom) {
                $errors['prenom'] = "doit contenir entre 3 à 255 caractères";
            } else {
                $regexPrenom = regex($prenom, "(^[0-9a-zA-Zçéèâôîû_]+$)");
                if (!$regexPrenom) {
                    $errors['prenom'] = "contient des caractères invalide.";
                }
            }
        }

        if (empty($data['utilisateur'])) {
            $errors['utilisateur'] = "Le champs utilisateur est requis.";
        } else {
            $utilisateur = $data['utilisateur'];
            $lenghtBetweenUtilisateur = lenghtBetween($utilisateur, 3, 50);
            if ($lenghtBetweenUtilisateur) {
                $errors['utilisateur'] = "doit contenir entre 3 à 255 caractères.";
            } else {
                $regexUtilisateur = regex($utilisateur, "(^[0-9a-zA-Z_]+$)");
                if (!$regexUtilisateur) {
                    $errors['utilisateur'] = "contient des caractères invalide.";
                } else {
                    $hasUsername = hasFieldUser('utilisateur', $utilisateur);
                    if ($hasUsername) {
                        $errors['utilisateur'] = "'$utilisateur' est utilisé.";
                    }
                }
            }
        }

        if (empty($data['email'])) {
            $errors['email'] = "Le champs email est requis.";
        } else {
            $email = $data['email'];
            $isEmail = isEmail($email);
            if (!$isEmail) {
                $errors['email'] = "l'email '$email' n'est pas valide.";
            } else {
                $hasEmail = hasFieldUser('email', $email);
                if ($hasEmail) {
                    $errors['email'] = "cette adresse email est utilisé.";
                }
            }
        }

        if (empty($data['password'])) {
            $errors['password'] = "Le champs password est requis.";
        } else {
            $pass = $data['password'];
            $regexPass = regex($pass, "(^[0-9a-zA-Z_]+$)");
            if (!$regexPass) {
                $errors['password'] = "contient des caractères invalide.";
            } else {
                $lenMinPass = lenghtMin($pass, 8);
                if ($lenMinPass) {
                    $errors['password'] = "doit avoir au moins 8 caractères.";
                }
            }
        }
    }

    return $errors;
}


function getErrorUserConfirm($data) {
    $errors = [];
    if (!empty($data)) {
        if (empty($data['code'])) {
            $errors['code'] = "Le champs code est requis.";
        } else {
            $code = $data['code'];
            $equal = isEqual(strlen($code), 8);
            if (!$equal) {
                $errors['code'] = "doit avoir  8 caractères.";
            } else {
                $regex = regex($code, "(^[0-9a-zA-Z_]+$)");
                if (!$regex) {
                    $errors['code'] = "contient des caractères invalide.";
                } else {
                    $has = hasFieldUser('code', $code);
                    if (!$has) {
                        $errors['code'] = "Le code est incorrect.";   
                    }
                }
            }
        }
    }

    return $errors;
}


function getErrorUserLogin($data) {
    $errors = [];

    if (!empty($data)) {
        if (empty($data['utilisateur'])) {
            $errors['utilisateur'] = "Le champs utilisateur est requis.";
        } else {
            $utilisateur = $data['utilisateur'];
            $has = hasFieldOrField($utilisateur, 'utilisateur', 'email');
            if ($has) {
                $errors['utilisateur'] = "L'identifiant '$utilisateur' est incorrect.";
            }
        }

        if (empty($data['password'])) {
            $errors['password'] = "Le champs password est requis.";
        } else {
            $pass = $data['password'];
            $regexPass = regex($pass, "(^[0-9a-zA-Z_]+$)");
            if (!$regexPass) {
                $errors['password'] = "contient des caractères invalide.";
            } else {
                $lenMinPass = lenghtMin($pass, 8);
                if ($lenMinPass) {
                    $errors['password'] = "doit avoir au moins 8 caractères.";
                }
            }
        }
    }

    return $errors;
}


function getErrorUserEdit($data, $userid) {
    $errors = [];
    if (!empty($data)) {
        if (empty($data['nom'])) {
            $errors['nom'] = "Le champs nom est requis.";
        } else {
            $nom = $data['nom'];
            $lenghtBetweenNom = lenghtBetween($nom, 3, 255);
            if ($lenghtBetweenNom) {
                $errors['nom'] = "doit contenir entre 3 à 255 caractères";
            } else {
                $regexNom = regex($nom, "(^[0-9a-zA-Z_]+$)");
                if (!$regexNom) {
                    $errors['nom'] = "contient des caractères invalide.";
                }
            }
        }

        if (empty($data['prenom'])) {
            $errors['prenom'] = "Le champs prénom est requis.";
        } else {
            $prenom = $data['prenom'];
            $lenghtBetweenPrenom = lenghtBetween($prenom, 3, 255);
            if ($lenghtBetweenPrenom) {
                $errors['prenom'] = "doit contenir entre 3 à 255 caractères";
            } else {
                $regexPrenom = regex($prenom, "(^[0-9a-zA-Z_]+$)");
                if (!$regexPrenom) {
                    $errors['prenom'] = "contient des caractères invalide.";
                }
            }
        }

        if (empty($data['utilisateur'])) {
            $errors['utilisateur'] = "Le champs utilisateur est requis.";
        } else {
            $utilisateur = $data['utilisateur'];
            $lenghtBetweenUtilisateur = lenghtBetween($utilisateur, 3, 50);
            if ($lenghtBetweenUtilisateur) {
                $errors['utilisateur'] = "doit contenir entre 3 à 255 caractères.";
            } else {
                $regexUtilisateur = regex($utilisateur, "(^[0-9a-zA-Z_]+$)");
                if (!$regexUtilisateur) {
                    $errors['utilisateur'] = "contient des caractères invalide.";
                } else {
                    $hasUsername = hasFieldUser('utilisateur', $utilisateur, $userid);
                    if ($hasUsername) {
                        $errors['utilisateur'] = "'$utilisateur' est utilisé.";
                    }
                }
            }
        }

        if (empty($data['email'])) {
            $errors['email'] = "Le champs email est requis.";
        } else {
            $email = $data['email'];
            $isEmail = isEmail($email);
            if (!$isEmail) {
                $errors['email'] = "l'email '$email' n'est pas valide.";
            } else {
                $hasEmail = hasFieldUser('email', $email, $userid);
                if ($hasEmail) {
                    $errors['email'] = "cette adresse email est utilisé.";
                }
            }
        }
    }

    return $errors;
}


function getErrorUserPass($data) {
    $errors = [];
    $confirm = "";
    
    if (empty($data)) return $errors;

    if (empty($data['confirm'])) {
        $errors['confirm'] = "Le champs confirmation du mot de passe est requis.";
    } else {
        $confirm = $data['confirm'];
        $regexConfirm = regex($confirm, "(^[0-9a-zA-Z_]+$)");
        if (!$regexConfirm) {
            $errors['password'] = "contient des caractères invalide.";
        } else {
            $lenMinConfirm = lenghtMin($confirm, 8);
            if ($lenMinConfirm) {
                $errors['confirm'] = "doit avoir au moins 8 caractères.";
            }
        }
    }

    if (empty($data['password'])) {
        $errors['password'] = "Le champs password est requis.";
    } else {
        $pass = $data['password'];
        $regexPass = regex($pass, "(^[0-9a-zA-Z_]+$)");
        if (!$regexPass) {
            $errors['password'] = "contient des caractères invalide.";
        } else {
            $lenMinPass = lenghtMin($pass, 8);
            if ($lenMinPass) {
                $errors['password'] = "doit avoir au moins 8 caractères.";
            } else {
                $equal = isEquals($pass, $confirm);

                if (!$equal && !empty($confirm)) {
                    $errors['password'] = "les deux mot de passe ne correspondent pas.";
                }
            }
        }
    }


    return $errors;
}

function getErrorUserYourEmail($data) {
    if (empty($data)) return [];

    $errors = [];

    if (empty($data['email'])) {
        $errors['email'] = "Le champs email est requis.";
    } else {
        $email = $data['email'];
        $isEmail = isEmail($email);
        if (!$isEmail) {
            $errors['email'] = "l'email '$email' n'est pas valide.";
        } else {
            $hasEmail = hasFieldUser('email', $email);
            if (!$hasEmail) {
                $errors['email'] = "aucun compte associé à cette adresse email.";
            }
        }
    }

    return $errors;
}

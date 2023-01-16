<?php


function getErrorContact($data) {
    $errors = [];
    if (!empty($data)) {
        
        if (empty($_POST['nom'])) {
            $errors["nom"] = "est obligatoire.";
        }
  

        if (empty($_POST['email'])) {
            $errors["email"] = "est obligatoire.";
        } 

        if (empty($_POST['message'])) {
            $errors["message"] = "est obligatoire.";
        } 
    }

    return $errors;
}
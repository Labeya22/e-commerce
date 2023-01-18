<?php

$token = getQueryParamsString('token');
if (empty($token) || is_null($token)) {
    echo json_encode(['errors' => "une erreur est survenue lors de l'envoi de données"]);
} else {
    
    $memory = getSaveMemoryData($token);

    if (is_null($memory)) {
        $redirect = generate('admin.vehicule-create');
        echo json_encode(['expirate' => $redirect]);
    } else {
        $errors = getErrorVehiculeUploadImage($_FILES['uploader-file'] ?? []);
        $json = [];
        if (!empty($_FILES['uploader-file']) && empty($errors)) {
            $file = $_FILES['uploader-file']['name'];
            $temp = $_FILES['uploader-file']['tmp_name'];
            $basename = pathinfo($file, PATHINFO_BASENAME);
            [$post, $_] = $memory;
            $marque = getMarque($post['marque']);
            $type = getTypes($post['type']);
            if (empty($marque) || empty($type)) {
                echo json_encode(['errors' => "une erreur est survenue, merci de réessayer."]);
            }  else {
                createFolder($marque['marque'], $type['type']);
                $image = createFile($file, 30);
                $post['image'] = $image;
                $create = createVehicule($post);
                if ($create) {
                    move([$marque['marque'], $type['type'], $image], $temp);
                    echo json_encode(['errors' => "ok"]);

                } else {
                    echo json_encode(['errors' => "nous n'avons pas pu enregistré le vehicule"]);
                }
            }
        } 
        
        else echo json_encode($errors); 
    }    
}


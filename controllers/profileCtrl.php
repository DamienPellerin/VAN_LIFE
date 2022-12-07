<?php
include(dirname(__FILE__) . '/../config/config.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    // L'idéal serait de créer une fonction qui gère l'enregistrement sur le serveur

    try {
        if (!isset($_FILES['profile'])) {
            throw new Exception('Erreur !');
        }

        if ($_FILES['profile']['error'] != 0) {
            throw new Exception('Erreur :'.$_FILES['profile']['error']);
        }

        if (!in_array($_FILES['profile']['type'], SUPPORTED_FORMATS)) {
            throw new Exception('Format non autorisé');
        }

        if ($_FILES['profile']['size'] > MAX_SIZE) {
            throw new Exception('Poids supérieur à la limite (5Mo)');
        }

        $from = $_FILES['profile']['tmp_name'];
        $filename = '12-original'; //$user->id.'.jpg';
        $extension = $extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
        $to = UPLOAD_USER_PROFILE . $filename . '.' . $extension;

        if (!move_uploaded_file($from, $to)) {
            throw new Exception('problème lors du transfert');
        }

        $dst_x = 0;
        $dst_y = 0;
        $src_x = 0;
        $src_y = 0;
        $dst_width = 500;
        $src_width = getimagesize($to)[0];
        $src_height = getimagesize($to)[1];
        $dst_height = round(($dst_width * $src_height) / $src_width);
        $dst_image = imagecreatetruecolor($dst_width, $dst_height);
        $src_image = imagecreatefromjpeg($to);

        // Redimensionne
        imagecopyresampled(
            $dst_image,
            $src_image,
            $dst_x,
            $dst_y,
            $src_x,
            $src_y,
            $dst_width,
            $dst_height,
            $src_width,
            $src_height
        );

        // redimensionne l'image
        $resampledDestination = UPLOAD_USER_PROFILE . '/12-resampled.jpg';
        imagejpeg($dst_image, $resampledDestination, 75);


        // Recadre
        $cropped_width = 200;
        $ressourceResampled = imagecreatefromjpeg($resampledDestination);
        if (!$ressourceResampled) {
            throw new Exception('Problème lors du recadrage');
        }
        $ressourceCropped = imagecrop($ressourceResampled, ['x' => ($dst_width - $cropped_width) / 2, 'y' => 0, 'width' => $cropped_width, 'height' => 200]);

        // Sauvegarde l'image recadrée
        $croppedDestination = UPLOAD_USER_PROFILE . '/12-cropped.jpg';
        imagejpeg($ressourceCropped, $croppedDestination, 75);
    } catch (\Exception $e) {
        $error = $e->getMessage();
    }
}


include(dirname(__FILE__) . '/../views/profile.php');

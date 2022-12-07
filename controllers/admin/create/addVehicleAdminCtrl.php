<?php

require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../models/Vehicle.php');

if(isset($_SESSION['user']) && ($_SESSION['user']->role != 1)){
    header('Location: /controllers/homeController.php');
    exit();
}else{
try { 
//DONNÉES RECU EN METHOD POST//
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // CHAMP DU NOM VERIFICATION//
        //NETTOYAGE
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
        //VALIDATION
        if (empty($name)) {
            $error['errorName'] = 'Ce champ est vide';
        } else {
            $isOk = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if ($isOk == false) {
                $error['errorName'] = 'La donnée n\'est pas valide';
            }
        }

        // CHAMP DESCRIPTION VERIFICATION//
        //NETTOYAGE
        $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS));
        //VALIDATION
        if (empty($description)) {
            $error['errordescription'] = 'Ce champ est vide';
        } else {
            $isOk = filter_var($description, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if ($isOk == false) {
                $error['errorfirstname']  = 'La donnée n\'est pas valide';
            }
        }
        //
        // CHAMP PRIX//
        //NETTOYAGE
        $price = intval(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT));
        //VALIDATION
        if (empty($price)) {
            $error['errorprice']  = 'Ce champ est vide';
        }


        if (empty($error)) {
            $vehicle = new Vehicle();
            $vehicle->setName($name);
            $vehicle->setDescription($description);
            $vehicle->setPrice($price);
            //$vehicle->setId_agencies($_SESSION['id_agencies']); 
            $isAddedVehicle = $vehicle->addVehicle();


            if ($isAddedVehicle) {
                
                $pdo = Database::getInstance();
                   $lastinsertid = $pdo->lastinsertid();

                if (!isset($_FILES['profile'])) {
                    throw new Exception('Erreur !');
                }

                if ($_FILES['profile']['error'] != 0) {
                    throw new Exception('Erreur :' . $_FILES['profile']['error']);
                }

                if (!in_array($_FILES['profile']['type'], SUPPORTED_FORMATS)) {
                    throw new Exception('Format non autorisé');
                }

                if ($_FILES['profile']['size'] > MAX_SIZE) {
                    throw new Exception('Poids supérieur à la limite (5Mo)');
                }

                $from = $_FILES['profile']['tmp_name'];
                $filename = $lastinsertid; //$user->id.'.jpg';
                $extension = $extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
                $to = UPLOAD_VEHICLE_PROFILE . $filename . '.jpg' ;

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
                $resampledDestination = UPLOAD_VEHICLE_PROFILE . $lastinsertid.'.jpg';
                imagejpeg($dst_image, $resampledDestination, 75);
            }
                SessionFlash::set('Votre vehicule à bien été créé');
                header('location: /controllers/admin/adminCtrl.php');
                exit;
            } else {
                SessionFlash::set('Une erreur est survenue');
                header('location: /controllers/admin/adminCtrl.php');
                exit;
            }
        }
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}
}

include(__DIR__ . '/../../../views/templates/header.php');
include(__DIR__ . '/../../../views/addVehicleAdmin.php');
include(__DIR__ . '/../../../views/templates/footer.php');
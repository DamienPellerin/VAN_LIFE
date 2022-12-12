<?php

require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../models/Vehicle.php');

if(isset($_SESSION['user']) && ($_SESSION['user']->role != 1)){
    header('Location: /controllers/homeController.php');
    exit();
}else{
try {

    $vehicleId = intval($_GET['id']);
    $vehicle = Vehicle::read($vehicleId);
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

        if (empty($errors)) {

            //**** HYDRATATION ****/
            $vehicle = new Vehicle($vehicleId);
            $vehicle->setName($name);
            $vehicle->setDescription($description);
            $vehicle->setPrice($price);
            $vehicle->setId($vehicleId);
            $isModifyVehicle = $vehicle->updateVehicle();
        }
        if ($isModifyVehicle) {
            SessionFlash::set('Le véhicule  à bien été modifié');
            header('location: /controllers/admin/adminCtrl.php');
            exit;
        } else {
            SessionFlash::set('Une erreur est survenue');
            header('location: /controllers/modify/modifyVehicleAdminCtrl.php');
            exit;
        }
    }
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}}


include(__DIR__ . '/../../../views/templates/header.php');
include(__DIR__ . '/../../../views/modifyVehicleAdmin.php');
include(__DIR__ . '/../../../views/templates/footer.php');

<?php

require_once(__DIR__ . '/../../../models/Vehicle.php');

try {
    
    ///Récupération de l'ID du vehicule
    $vehicleId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //Supression du vehicule
    $isdeleteVehicle = Vehicle::deleteVehicle($vehicleId);

    if ($isdeleteVehicle) {

        SessionFlash::set('Le vehicule à bien été supprimé'); 
        header('Location: /espace-administrateur');
        exit;

    } else {

        SessionFlash::set('Erreur'); 

    }

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
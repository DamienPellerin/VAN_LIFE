<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Agencie.php');
require_once(__DIR__ . '/../models/Vehicle.php');
try {

    //Récupération de l'ID agence
    $agencieId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    //Affichage des données des agences
    $agencies = Agencie::readAll();

    //Récupération de l'ID agence
     $vehicleId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    //Affichage des données des véhicules
     $vehicles = Vehicle::readAll();

     
} catch (PDOException $e) {
    echo $e->getMessage();
}
include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/agenciesInfo.php');
include(__DIR__ . '/../views/templates/footer.php');

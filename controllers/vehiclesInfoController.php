<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Vehicle.php');
require_once(__DIR__ . '/../models/Agencie.php');
try {
    //Récupération de l'ID agence
    $vehicleId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $vehicles = Vehicle::readAll();

    //Récupération de l'ID agence
    $agencieId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $agencies = Agencie::readAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/vehiclesInfo.php');
include(__DIR__ . '/../views/templates/footer.php');

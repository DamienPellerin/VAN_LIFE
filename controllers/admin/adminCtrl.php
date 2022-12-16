<?php

require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../models/Vehicle.php');
require_once(__DIR__ . '/../../models/User.php');
require_once(__DIR__ . '/../../models/Agencie.php');
require_once(__DIR__ . '/../../models/Location.php');

if(isset($_SESSION['user']) && ($_SESSION['user']->role != 1)){
    
    header('Location: /controllers/homeController.php');
    exit();
    
}else{

try {

    //Récupération de l'ID utilisateur
    $userId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    //Affichage des informations de l'utilisateur
    $users = User::readAll();
  

    //Récupération de l'ID vehicule
    $vehicleId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    //Affichage des informations du vehicule
    $vehicles = Vehicle::readAll();
   

    //Récupération de l'ID agence
    $agencieId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    //Affichage des informations de l'agence
    $agencies = Agencie::readAll();
    
    //Affichage des données des locations
    $userLocation = Location::readAll();
  
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

}
include(__DIR__ . '/../../views/templates/header.php');
include(__DIR__ . '/../../views/admin.php');
include(__DIR__ . '/../../views/templates/footer.php');

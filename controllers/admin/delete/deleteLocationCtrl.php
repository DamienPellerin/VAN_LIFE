<?php

require_once(__DIR__ . '/../../../models/Location.php');
try {
    
    ///Récupération de l'ID de l'agence
    $locationId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //Supression du rendez-vous
    $isdeleteLocation = Location::deleteLocation($locationId);

    if ($isdeleteLocation) {
        SessionFlash::set('La location à bien été supprimé'); 
        header('Location: /espace-administrateur');
        exit;
    } else {
        SessionFlash::set('Erreur'); 
    }

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
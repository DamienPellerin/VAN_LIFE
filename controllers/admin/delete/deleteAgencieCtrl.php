<?php

require_once(__DIR__ . '/../../../models/Agencie.php');
try {
    
    ///Récupération de l'ID de l'agence
    $agencieId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //Supression de l'agence
    $isdeleteAgencie = Agencie::deleteAgencie($agencieId);

    if ($isdeleteAgencie) {

        SessionFlash::set('L\'agence à bien été supprimé'); 

        header('Location: /espace-administrateur');
        exit;

    } else {

        SessionFlash::set('Erreur'); 
        
    }

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
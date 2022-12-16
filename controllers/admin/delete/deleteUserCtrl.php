<?php

require_once(__DIR__ . '/../../../models/User.php');

try {
    
    ///Récupération de l'ID utilisateur
    $userId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //Supression de l'utilisateur
    $isdeleteUser = User::deleteUser($userId);

    if ($isdeleteUser) {

        SessionFlash::set('L\'utilisateur à bien été supprimé'); 
        header('Location: /espace-administrateur');
        exit;

    } else {

        SessionFlash::set('Erreur'); 
        
    }

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
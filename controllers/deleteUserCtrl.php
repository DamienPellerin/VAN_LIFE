<?php

require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../models/User.php');

try{
  
 //Récupération de l'ID utilisateur
 $userId = intval($_SESSION['user']->id_users);

// suppression de l'utilisateur

if(User::deleteUser($userId) == true){
unset($_SESSION['user']);   

SessionFlash::set('Votre compte a bien été supprimé');
header('Location: /controllers/connectionController.php');
die;

}else{
    SessionFlash::set('Erreur lors de la suppression de votre compte');
}

} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/userDashboard.php');
include(__DIR__.'/../views/templates/footer.php');
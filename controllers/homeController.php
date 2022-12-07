<?php
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__ . '/../models/Agencie.php');
require_once(__DIR__ . '/../models/Vehicle.php');
try{
//Récupération des donnnées de l'agence
    $agencies = Agencie::readAll();
    $vehicles = Vehicle::readAll();
    
}
catch(PDOException $e){
    echo $e->getMessage();
}

include(__DIR__ . './../views/templates/header.php');
include(__DIR__ . './../views/home.php');
include(__DIR__ . './../views/templates/footer.php');
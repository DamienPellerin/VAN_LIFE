<?php
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../models/Vehicle.php');
try{
    
$vehicles = Vehicle::readAll();
 
}catch(PDOException $e){
    echo $e->getMessage();
}

include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/vehicles.php');
include(__DIR__.'/../views/templates/footer.php');
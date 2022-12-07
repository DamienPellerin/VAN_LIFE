<?php
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../models/Agencie.php');
try{
    
$agencies = Agencie::readAll();
 
}catch(PDOException $e){
    echo $e->getMessage();
}

include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/agencies.php');
include(__DIR__.'/../views/templates/footer.php');
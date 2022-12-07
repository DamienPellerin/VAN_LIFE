<?php

require_once(__DIR__.'/../../../config/config.php');
require_once(__DIR__.'/../../../models/Location.php');
require_once(__DIR__.'/../../../models/Agencie.php');
require_once(__DIR__.'/../../../models/Vehicle.php');
try{

    $agencies = Agencie::readAll();

    $vehicles = Vehicle::readAll();
    //Récupération de l'ID de la location
    $reservationId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $reservation = Location::read($reservationId);

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     // CHAMP DE L'AGENCE VERIFICATION//
     //NETTOYAGE
     $agencie = trim(filter_input(INPUT_POST, 'agencie', FILTER_SANITIZE_SPECIAL_CHARS));
     //VALIDATION
     if (empty($agencie)) {
         $error['errorAgencie'] = 'Ce champ est vide';
     } else {
         $isOk = filter_var($agencie, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
         if ($isOk == false) {
             $error['errorAgencie'] = 'La donnée n\'est pas valide';
         }
     }

     $dateDeparture = filter_input(INPUT_POST, 'departure', FILTER_SANITIZE_SPECIAL_CHARS);
     if (!empty($dateDeparture)) {
         $isOk = filter_var($dateDeparture, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
         if (!$isOk) {
             $error["dateDeparture"] = "La date entrée n'est pas valide!";
         }
     }

     $dateReturn = filter_input(INPUT_POST, 'return', FILTER_SANITIZE_SPECIAL_CHARS);
     if (!empty($dateReturn)) {
         $isOk = filter_var($dateReturn, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
         if (!$isOk) {
             $error["dateReturn"] = "La date entrée n'est pas valide!";
         }
     }

     $id_vehicles = intval(filter_input(INPUT_POST, 'vehicle', FILTER_SANITIZE_NUMBER_INT));
    if (empty($id_vehicles)) {
        $error["vehicle"] = "Impossible d'identifier le vehicule!";
     }
     if (empty($errors)) {

         //**** HYDRATATION ****/
         $location = new Location();
         $location->setRental_date($dateDeparture);
         $location->setReturn_date($dateReturn);
         $location->setId_vehicles($id_vehicles);
         $location->setId_agencies($agencie);

         $isModifyLocation = $location->updateLocation($reservationId);

         if ($isModifyLocation) {
             SessionFlash::set('La location à bien été modifié');
             header('location: /controllers/admin/adminCtrl.php');
             exit;

         } else {
             SessionFlash::set('Une erreur est survenue');
             header('location: /controllers/user/modify/modifyLocationUserAdminCtrl.php');
             exit;
         }
     }
 }
} catch (Exception $e) {
 echo $e->getMessage();
 die();
}

include(__DIR__ . '/../../../views/templates/header.php');
include(__DIR__ . '/../../../views/modifyLocationUserAdmin.php');
include(__DIR__ . '/../../../views/templates/footer.php');

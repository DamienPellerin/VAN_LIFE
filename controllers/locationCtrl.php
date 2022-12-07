<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Location.php');

try{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        // CHAMP DE L'AGENCE VERIFICATION//
        //NETTOYAGE
        $agencie = trim(filter_input(INPUT_GET, 'agencie', FILTER_SANITIZE_SPECIAL_CHARS));
        //VALIDATION
        if (empty($agencie)) {
            $error['errorAgencie'] = 'Ce champ est vide';
        } else {
            $isOk = filter_var($agencie, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if ($isOk == false) {
                $error['errorAgencie'] = 'La donnée n\'est pas valide';
            }
        }
        $dateDeparture = filter_input(INPUT_GET, 'departure', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($dateDeparture)) {
            $isOk = filter_var($dateDeparture, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["dateDeparture"] = "La date entrée n'est pas valide!";
            }
        }

        $dateReturn = filter_input(INPUT_GET, 'return', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($dateReturn)) {
            $isOk = filter_var($dateReturn, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["dateReturn"] = "La date entrée n'est pas valide!";
            }
        }

        $vehicle = trim(filter_input(INPUT_GET, 'vehicle', FILTER_SANITIZE_SPECIAL_CHARS));
        if (!empty($vehicle)) {
            $isOk = filter_var($vehicle, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_NO_NUMBER . '/']]);
            if (!$isOk) {
                $error["vehicle"] = "Une erreur est survenue!";
            }
        }

        $id_vehicles = intval(filter_input(INPUT_GET, 'id_vehicles', FILTER_SANITIZE_NUMBER_INT));
        if (empty($id_vehicles)) {
            $error["vehicle"] = "Impossible d'idantifier le vehicule!";
        }
        if (empty($error)) {
            $location = new Location();
            $location->setRental_date($dateDeparture);
            $location->setReturn_date($dateReturn);
            $location->setid_users($_SESSION['user']->id_users);
            $location->setid_vehicles($id_vehicles);
            //$agencie->setCity($city);
            //$agencie->setZipcode($zipcode);
            $isAddedLocation = $location->addLocation();

          if ($isAddedLocation) {
              SessionFlash::set('La réservation à bien été effectuée');
              header('location: /controllers/userDashboardCtrl.php');
              exit;
          } else {
              SessionFlash::set('Une erreur est survenue');
              header('location: /controllers/recapCtrl.php');
              exit;
          }
        }
    }

} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/recap.php');
include(__DIR__ . '/../views/templates/footer.php');
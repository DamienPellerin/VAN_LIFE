<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Vehicle.php');
require_once(__DIR__ . '/../models/Agencie.php');

if (!isset($_SESSION['user'])) {
    header('Location: /controllers/connectionController.php');
    exit();

} else {
    try {
        //Récupération agence
        $agencie = trim(filter_input(INPUT_GET, 'agencie', FILTER_SANITIZE_SPECIAL_CHARS));
        $agencie = Agencie::read($agencie);

        //Récupération  date de départ
        $dateDeparture = intval(filter_input(INPUT_GET, 'departure', FILTER_SANITIZE_SPECIAL_CHARS));

        //Récupération date de retour
        $dateReturn = intval(filter_input(INPUT_GET, 'return', FILTER_SANITIZE_SPECIAL_CHARS));

        //Affichage des informations des vehicules
        $vehicles = Vehicle::readAll();
       
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
            if (!empty($date)) {
                $isOk = filter_var($date, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
                if (!$isOk) {
                    $error["date"] = "La date entrée n'est pas valide!";
                }
            }

            $dateReturn = filter_input(INPUT_GET, 'return', FILTER_SANITIZE_SPECIAL_CHARS);
            if (!empty($date)) {
                $isOk = filter_var($date, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
                if (!$isOk) {
                    $error["date"] = "La date entrée n'est pas valide!";
                }
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/reservation.php');
include(__DIR__ . '/../views/templates/footer.php');

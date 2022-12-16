<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Location.php');
require_once(__DIR__ . '/../models/Vehicle.php');
require_once(__DIR__ . '/../models/Agencie.php');
require_once(__DIR__ . '/../models/User.php');

$userId = intval($_SESSION['user']->id_users);
$user = User::displayUser($userId);

$id_agencies = intval(filter_input(INPUT_GET, 'agencie', FILTER_SANITIZE_NUMBER_INT));
if (empty($id_agencies)) {
    $error["agencie"] = "Impossible d'identifier l'agence'!";
}

//Récupération agence
$agencie = Agencie::read($id_agencies);

$vehicleId = intval(filter_input(INPUT_GET, 'vehicle', FILTER_SANITIZE_NUMBER_INT));
if (empty($vehicleId)) {
    $error["vehicle"] = "Une erreur est survenue!";
}

//Récupération vehicule
$vehicle = Vehicle::read($vehicleId);

//Récupération  date de départ
$dateDeparture = trim(filter_input(INPUT_GET, 'departure', FILTER_SANITIZE_SPECIAL_CHARS));

//Récupération date de retour
$dateReturn = trim(filter_input(INPUT_GET, 'return', FILTER_SANITIZE_SPECIAL_CHARS));



try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $validate = filter_input(INPUT_POST, 'validate', FILTER_SANITIZE_NUMBER_INT);
        if ($validate == 1) {
            // CHAMP DE L'AGENCE VERIFICATION//
            //NETTOYAGE

            $dateDeparture = filter_input(INPUT_GET, 'departure', FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($dateDeparture)) {
                $isOk = filter_var($dateDeparture, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
                if (!$isOk) {
                    $error["dateDeparture"] = "La date entrée n'est pas valide!";
                }
            }
            $dateDeparture .= ' 09:00:00';

            $dateReturn = filter_input(INPUT_GET, 'return', FILTER_SANITIZE_SPECIAL_CHARS);
            if (!empty($dateReturn)) {
                $isOk = filter_var($dateReturn, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
                if (!$isOk) {
                    $error["dateReturn"] = "La date entrée n'est pas valide!";
                }
            }
            $dateReturn .= ' 12:00:00';

            if (empty($error)) {
                $location = new Location();
                $location->setRental_date($dateDeparture);
                $location->setReturn_date($dateReturn);
                $location->setId_users($_SESSION['user']->id_users);
                $location->setId_agencies($id_agencies);
                $location->setId_vehicles($vehicle->id_vehicles);

                //$agencie->setCity($city);
                //$agencie->setZipcode($zipcode);
                $isAddedLocation = $location->addLocation();

                if ($isAddedLocation) {
                    SessionFlash::set('Votre reservation à bien été effectuée');
                    header('location: /controllers/user/userDashboardCtrl.php');
                    exit;
                } else {
                    SessionFlash::set('Une erreur est survenue');
                    header('location: /controllers/recapCtrl.php');
                    exit;
                }
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

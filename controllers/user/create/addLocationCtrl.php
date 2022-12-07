<?php
require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../models/Agencie.php');

try {
    //DONNÉES RECU EN METHOD POST//
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // CHAMP DU NOM VERIFICATION//
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

        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($date)) {
            $isOk = filter_var($date, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["date"] = "La date entrée n'est pas valide!";
            }
        }
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
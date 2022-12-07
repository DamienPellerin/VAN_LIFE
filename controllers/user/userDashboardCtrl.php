<?php

require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../models/User.php');
require_once(__DIR__ . '/../../models/Location.php');

try {

    //Récupération de l'ID utilisateur
    $userId = intval($_SESSION['user']->id_users);
    $userLocation = Location::readProfilLocation($userId);

    //DONNÉES RECU EN METHOD POST//
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // CHAMP DU NOM VERIFICATION//
        //NETTOYAGE
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
        //VALIDATION
        if (empty($lastname)) {
            $error['errorName'] = 'Ce champ est vide';
        } else {
            $isOk = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if ($isOk == false) {
                $error['errorName'] = 'La donnée n\'est pas valide';
            }
        }

        // CHAMP DU PRÉNOM VERIFICATION//
        //NETTOYAGE
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        //VALIDATION
        if (empty($firstname)) {
            $error['errorfirstname'] = 'Ce champ est vide';
        } else {
            $isOk = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if ($isOk == false) {
                $error['errorfirstname']  = 'La donnée n\'est pas valide';
            }
        }

        // CHAMP DATE DE NAISSANCE VERIFICATION//
        //NETTOYAGE
        $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT));
        //VALIDATION
        if (empty($birthdate)) {
            $error['errorbirthdate']  = 'Ce champ est vide';
        } else {
            $isOk = filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NUMBER . '/')));
            if (!$isOk) {
                $error['errorbirthdate'] = 'La donnée n\'est pas valide';
            }
        }

        // CHAMP DE L'EMAIL VERIFICATION//
        //NETTOYAGE
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
        if (User::mailExist($mail) == true) {
            $error['mail'] = 'Ce mail existe déjà';
        } else {
            //**** VERIFICATION ****/
            if (empty($mail)) {
                $error['mail'] = 'Le champ est obligatoire';
            } else {
                $isOk = filter_var($mail, FILTER_VALIDATE_EMAIL);
                if (!$isOk) {
                    $error['mail'] = 'Le mail n\'est pas valide';
                }
            }
        }

        // CHAMP DE L'ADRESSE VERIFICATION//
        //NETTOYAGE
        $adress = trim(filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_SPECIAL_CHARS));


        // CHAMP DU TÉLÉPHPONE VERIFICATION//
        //NETTOYAGE
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
        //VALIDATION
        if (!empty($phone)) {
            $isOk = filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PHONE . '/')));
            if ($isOk == false) {
                $error['phone'] = 'La donnée n\'est pas valide';
            }
        }

        // CHAMP DU CODE POSTAL VERIFICATION//
        //NETTOYAGE
        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);
        //VALIDATION
        if (!empty($zipcode)) {
            $isOk = filter_var($zipcode, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_POSTAL . '/')));
            if ($isOk == false) {
                $error['zipcode'] = 'La donnée n\'est pas valide';
            }
        }

        // CHAMP DU CODE POSTAL VERIFICATION//
        //NETTOYAGE
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($errors)) {
                
            //**** HYDRATATION ****/
            $user = new User($userId);
            $user->setLastname($lastname);
            $user->setFirstname($firstname);
            $user->setMail($mail);
            $user->setPhone($phone);
            $user->setBirthdate($birthdate);
            $user->setAdress($adress);
            $user->setId($userId);
            $user = $user->update();
        }
    }
    
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../../views/templates/header.php');
include(__DIR__ . '/../../views/userDashboard.php');
include(__DIR__ . '/../../views/templates/footer.php');

<?php

require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../models/User.php');

try {

    //Récupération de l'ID utilisateur
    $userId = intval($_SESSION['user']->id_users);

    $userLastname = $_SESSION['user']->lastname ?? $lastname;
    $userFirstname = $_SESSION['user']->firstname ?? $firstname;
    $userZipcode = $_SESSION['user']->zipcode ?? $zipcode;
    $userBirthdate = $_SESSION['user']->birthdate ?? $birthdate;
    $userCity = $_SESSION['user']->city ?? $city;
    $userMail = $_SESSION['user']->mail ?? $mail;
    $userAdress = $_SESSION['user']->adress ?? $adress;
    $userPhone = $_SESSION['user']->phone ?? $phone;
    
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


        // CHAMP DU CODE POSTAL VERIFICATION//
        //NETTOYAGE
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);

        // CHAMP DE L'EMAIL VERIFICATION//
        //NETTOYAGE
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

        //**** VERIFICATION ****/
        if (empty($mail)) {
            $error['mail'] = 'Le champ est obligatoire';
        } else {
            $isOk = filter_var($mail, FILTER_VALIDATE_EMAIL);
            if (!$isOk) {
                $error['mail'] = 'Le mail n\'est pas valide';
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

        if (empty($errors)) {

            //**** HYDRATATION ****/
            $user = new User($userId);
            $user->setLastname($lastname);
            $user->setFirstname($firstname);
            $user->setMail($mail);
            $user->setPhone($phone);
            $user->setCity($city);
            $user->setZipcode($zipcode);
            $user->setBirthdate($birthdate);
            $user->setAdress($adress);
            $user->setId($userId);
            $isUpdatedUser = $user->update();
            $user = User::getByEmail($mail);
            $user->password = NULL;
            $_SESSION['user'] = $user;

            if ($isUpdatedUser) {
                SessionFlash::set('Votre compte à bien été modifié');
                 header('location: /controllers/user/userDashboardCtrl.php');
                exit;
            } else {
                SessionFlash::set('Une erreur est survenue');
                header('location: /modif-utilisateur');
                exit;
            }
        }
    }
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}


include(__DIR__ . '/../../../views/templates/header.php');
include(__DIR__ . '/../../../views/modifyUser.php');
include(__DIR__ . '/../../../views/templates/footer.php');

<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../helpers/JWT.php');
try {
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
       

        //CHAMP PASSWORD VERIFICATION//
        //NETTOYAGE
        $password = trim(filter_input(INPUT_POST, 'password'));
        //VALIDATION
        if (empty($password)) {
            $error['password'] = 'Ce champ est vide';
        } else {
            $isOk = filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')));
            if ($isOk == false) {
                $error['password'] = 'La donnée n\'est pas valide';
            }
        }

        //CHAMP CONFIRM PASSWORD VERIFICATION//
        //NETTOYAGE
        $confirmPassword = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
        //VALIDATION
        if (empty($confirmPassword)) {
            $error['confirm-password'] = 'Ce champ est vide';
        } else {
            $isOk = filter_var($confirmPassword, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/'))) && $confirmPassword == $password;
            if ($isOk == false) {
                $error['confirm-password'] = 'La donnée n\'est pas valide';
            }
        }
        
        if (empty($error)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user = new User();
            $user->setLastname($lastname);
            $user->setFirstname($firstname);
            $user->setMail($mail);
            $user->setPhone($phone);
            $user->setCity($city);
            $user->setZipcode($zipcode);
            $user->setBirthdate($birthdate);
            $user->setPassword($password);
            $user->setAdress($adress);
            $isAddedUser = $user->addUser();
            $id_user = $user->getId();
            $element = ['id'=> $id_user, 'mail'=> $mail];
            $element['valid'] = time() + 60*15;
            $token = JWT::set($element);
            if($user){
                $to = $mail;
                $subject = 'Inscription à notre super site!';
                $message = 'Veuillez cliquer : <a href="'.$_SERVER['HTTP_ORIGIN'].'/controllers/validateAccountCtrl.php?token='.$token.'">Cliquez-ici</a>';
                mail($to,$subject,$message);
                header('Location: /controllers/connectionController.php');
                exit;
            }

            if ($isAddedUser) {
                SessionFlash::set('Votre compte à bien été créé');
                header('location: /controllers/connectionController.php');
                exit;
            } else {
                SessionFlash::set('Une erreur est survenue');
                header('location: /controllers/registrationController.php');
                exit;
            }
        }
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/registration.php');
include(__DIR__ . '/../views/templates/footer.php');
        

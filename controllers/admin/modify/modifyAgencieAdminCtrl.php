<?php
require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../models/Agencie.php');

if (isset($_SESSION['user']) && ($_SESSION['user']->role != 1)) {

    header('Location: /controllers/homeController.php');
    exit();
} else {

    try {
        //DONNÉES RECU EN METHOD GET//
        $agencieId = intval($_GET['id']);

        //Affichage des données de l'agence
        $agencie = Agencie::read($agencieId);

        //DONNÉES RECU EN METHOD POST//
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // CHAMP DU NOM VERIFICATION//
            //NETTOYAGE
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
            //VALIDATION
            if (empty($name)) {
                $error['errorName'] = 'Ce champ est vide';
            } else {
                $isOk = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
                if ($isOk == false) {
                    $error['errorName'] = 'La donnée n\'est pas valide';
                }
            }

            // CHAMP DE L'ADRESSE VERIFICATION//
            //NETTOYAGE
            $adress = trim(filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_SPECIAL_CHARS));

            // CHAMP DESCRIPTION VERIFICATION//
            //NETTOYAGE
            $description = strip_tags($_POST['description']) ?? '';
            //VALIDATION
            if (empty($description)) {
                $error['errordescription'] = 'Ce champ est vide';
            }

             // CHAMP DU CODE POSTAL VERIFICATION//
            //NETTOYAGE
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);

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

            if (empty($error)) {
                //**** HYDRATATION ****/
                $agencie = new Agencie($agencieId);
                $agencie->setName($name);
                $agencie->setDescription($description);
                $agencie->setAdress($adress);
                $agencie->setCity($city);
                $agencie->setZipcode($zipcode);
                $agencie->setId($agencieId);
                $isModifyAgencie = $agencie->updateAgencie();
            }
            if ($isModifyAgencie) {

                SessionFlash::set('L\'agence  à bien été modifié');
                header('location: /controllers/admin/adminCtrl.php');
                exit;
            } else {

                SessionFlash::set('Une erreur est survenue');
                header('location: /controllers/admin/modify/modifyAgencieAdminCtrl.php');
                exit;
            }
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

include(__DIR__ . '/../../../views/templates/header.php');
include(__DIR__ . '/../../../views/modifyAgencieAdmin.php');
include(__DIR__ . '/../../../views/templates/footer.php');

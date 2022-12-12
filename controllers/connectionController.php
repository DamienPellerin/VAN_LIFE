<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/User.php');
try{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
    
        $password = trim(filter_input(INPUT_POST, 'password'));
        //VALIDATION
        if (empty($password)) {
            $error['password'] = 'Ce champ est vide';
        } else {
            $user = User::getByEmail($mail);
            //$password_hash = $user->getPassword();
            $password_hash = $user->password;
            $result = password_verify($password, $password_hash);
    
            if (!$result) {
                $error['password'] = 'Les informations de connexion ne sont pas bonnes!';
            }
        }
    
        if (empty($error)) {
            //$user->setPassword(null);
            $user->password = null;
            $_SESSION['user'] = $user;

                SessionFlash::set('Bienvenue');
                header('Location: /../controllers/homeController.php');
             } else { 
                SessionFlash::set('La connexion a échoué');
                header('Location: /../controllers/connectionController.php');
                exit;
             } 
        }
    }

catch(PDOException $e){
    echo $e->getMessage();
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/connection.php');
include(__DIR__ . '/../views/templates/footer.php');

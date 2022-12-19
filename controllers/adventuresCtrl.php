<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Comment.php');
require_once(__DIR__ . '/../models/User.php');

try {

//Affichage des données des commentaires
    $comments_user = Comment::readAll();

} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/adventures.php');
include(__DIR__ . '/../views/templates/footer.php');
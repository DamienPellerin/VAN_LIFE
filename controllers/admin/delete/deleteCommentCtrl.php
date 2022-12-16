<?php

require_once(__DIR__ . '/../../../models/Comment.php');
try {
    
    ///Récupération de l'ID de l'agence
    $commentId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //Supression du commentaire
    $isdeleteComment = Comment::deleteComment($commentId);

    if ($isdeleteComment) {

        SessionFlash::set('Le commentaire à bien été supprimé'); 
        header('Location: /controllers/adventuresCtrl.php');

    } else {

        SessionFlash::set('Une erreur c\'est produite'); 

    }

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
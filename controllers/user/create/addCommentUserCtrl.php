<?php

require_once(__DIR__ . '/../../../config/config.php');
require_once(__DIR__ . '/../../../models/Comment.php');
require_once(__DIR__ . '/../../../models/User.php');

$userId = intval($_SESSION['user']->id_users);

$user = User::displayUser($userId);

$comment_user = Comment::getComments($userId);

$comments_user = Comment::readAll();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // CHAMP DU NOM VERIFICATION//
        //NETTOYAGE
        $name = strip_tags($_POST['comment']) ?? '';

        //VALIDATION
        if (empty($name )) {
            $error['errorComment'] = 'Ce champ est vide';
        }


        if (empty($error)) {
            $comment = new Comment();
            $comment->setComment($name);
            $comment->setId_users($userId);
            $isAddedComment = $comment->addComment();
          
            if ($isAddedComment) {
                SessionFlash::set('Votre commentaire à bien été créé');
                header('Location: /controllers/user/userDashboardCtrl.php');
            } else {
                SessionFlash::set('Une erreur est survenue');
            }
        }
    }
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}
include(__DIR__ . '/../../../views/templates/header.php');
include(__DIR__ . '/../../../views/addCommentUser.php');
include(__DIR__ . '/../../../views/templates/footer.php');
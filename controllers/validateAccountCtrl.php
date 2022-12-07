<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../helpers/JWT.php');

$token = filter_input(INPUT_GET, 'token');

$element = JWT::get($token);

if($element){
    $isValidated = User::validateAccount($element->id);
    if($isValidated){
        header('Location: /controllers/connectionController.php');
        exit;
    } else {
        $error = 'Problème!';
    }
} else {
    $error = 'Problème!';
}
<?php
session_start();

unset($_SESSION['user']);

header('Location: /controllers/connectionController.php');
die;

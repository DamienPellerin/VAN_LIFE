<?php 

session_start();
require_once(__DIR__ . '/../helpers/SessionFlash.php');
//connection base de donées
define('DSN', 'mysql:host=localhost;dbname=vanlife');
define('USER', 'DamienPellerin');
define('PWD', 'hTF(x5]Sj[fmwIsd');

//DECLARATION DES REGEX//
define('REGEX_NO_NUMBER', "^[a-zA-ZÀ-ÿ '-]+$");
define('REGEX_DATE','^([0-9]{4})[\/\-]?([0-9]{2})[\/\-]?([0-9]{2})$');
define('REGEX_NUMBER', "^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$");
define('REGEX_PRICE', "^[0-9]{1,}$");
define('REGEX_PHONE', "^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$");
define('REGEX_EMAIL', "^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}$");
define('REGEX_POSTAL', "^[0-9]{5}$");
define('REGEX_PASSWORD', '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$');
define ('SECRET_KEY', 'fsdh&éé"&"&éff444dsf54q6fs`dsffsdqhg:::!dsq');

define('SUPPORTED_FORMATS', array('image/jpeg'));
define('MAX_SIZE', 5*1024*1024);
define('UPLOAD_AGENCIE_PROFILE', __DIR__ . '/../public/uploads/agencies/');
define('UPLOAD_VEHICLE_PROFILE', __DIR__ . '/../public/uploads/vehicles/');

// Formateur de date  ( echo $formatLongFr->format(strtotime("date en texte")) )
$formatDateFr = new IntlDateFormatter(
    'fr_FR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN,
    "EEEE dd MMMM Y",
 );
 $formatHourFr = new IntlDateFormatter(
    'fr_FR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN,
    "HH'h'",
 );
 

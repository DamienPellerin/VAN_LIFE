<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../config/dompdf/autoload.inc.php');
require_once(__DIR__ . '/../models/Vehicle.php');
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Agencie.php');
require_once(__DIR__ . '/../models/Location.php');

$userId = intval($_SESSION['user']->id_users);
$user = User::displayUser($userId);

$reservationId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$user = User::displayUserLocation($userId);
$reservation = Location::read($reservationId);
$reservationVehicle = Location::readVehiclelocation($reservationId);

//$location = Location::displayLocation($userId);

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Courier');

$dompdf = new Dompdf($options);
$dompdf->loadHtml('
<h1>Facture</h1>
<section class="user-pdf">
<p>' . ($_SESSION['user']->lastname) . ' ' . ($_SESSION['user']->firstname). '</p>
<p>Adresse : ' . ($_SESSION['user']->adress)  . '</p>
<p>Code postal : ' . ($_SESSION['user']->zipcode) . '</p>
<p>Ville : ' . ($_SESSION['user']->city) . '</p>
</section>

<p> Agence : '.$reservation->name.'</p> <p> Vehicule : '.$reservationVehicle->name.'</p>
<p> Date de départ : '.ucfirst($formatDateFr->format(strtotime($reservation->rental_date)))  .'  </p> 
<p> Date de retour : '.ucfirst($formatDateFr->format(strtotime($reservation->return_date)))  .'  </p>
<p> Prix : '.$reservationVehicle->price.' €/nuit</p> 

');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$file = ('facture.pdf');

$dompdf->stream('facture.pdf');

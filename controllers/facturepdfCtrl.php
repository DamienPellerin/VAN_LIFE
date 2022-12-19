<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dompdf/autoload.inc.php');
require_once(__DIR__ . '/../models/Vehicle.php');
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Agencie.php');
require_once(__DIR__ . '/../models/Location.php');

//RÉCUPERZTION DE L'ID DE LA 
$userId = intval($_SESSION['user']->id_users);

$userLocation = User::displayUser($userId);

//RÉCUPERATION DE L'ID DE LA RÉSERVATION
$reservationId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

//INFORMATION DE LA RÉSERVATION DE L'UTILISATEUR
$user = User::displayUserLocation($userId);

//AFFICHAGE DES RÉSERVATION DE L'UTILISATEUR
$reservation = Location::read($reservationId);

//INFORMATION DU VEHICULES DE LA RÉSERVATION
$reservationVehicle = Location::readVehiclelocation($reservationId);

//$location = Location::displayLocation($userId);

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();

//POLICE DE LA FACTURE
$options->set('defaultFont', 'Courier');

$dompdf = new Dompdf($options);
if (isset($_SESSION['user']) && ($_SESSION['user']->role != 1)) {

  //FACTURE FORMAT HTML
    $dompdf->loadHtml('
    <h1 style="text-align:center;">Facture</h1>
    <ul style="list-style:none;"> 
    <li>' . ($_SESSION['user']->lastname) . ' ' . ($_SESSION['user']->firstname) . '</li>
    <li>Adresse : ' . ($_SESSION['user']->adress) . '</li>
    <li>Code postal : ' . ($_SESSION['user']->zipcode) . '</li>
    <li>Ville : ' . ($_SESSION['user']->city) . '</li>
    </ul>
    
    <p> Agence : ' . $reservation->name . '</p> <p> Vehicule : ' . $reservationVehicle->name . '</p>
    <p> Date de départ : ' . ucfirst($formatDateFr->format(strtotime($reservation->rental_date)))  . '  </p> 
    <p> Date de retour : ' . ucfirst($formatDateFr->format(strtotime($reservation->return_date)))  . '  </p>
    <p> Prix : ' . $reservationVehicle->price . ' €/nuit</p> 
    
    ');
} else {
    $dompdf->loadHtml('
    <h1 style="text-align:center; margin-bottom:100px; font-size:35px;"> FACTURE </h1>
    <h2> VAN LIFE </h2>

<section(class="flex")>
  <dl>
    <dt style="margin-bottom:10px;"> Facture # </dt>
    <dd> ' . $reservation->id_registers . '  </dd>
    <dt> Date de facturation </dt>
    <dd> ' . $user->created_at . '</dd>
</section>

<section(class="flex")>
  <dl style="margin-bottom:30px;>
    <dt> Facturé à: </dt>
    <dd> ' . $reservation->lastname . ' ' . $reservation->firstname . '</dd>
      | ' . $reservation->adress . '<br>
      | ' . $reservation->zipcode . ' ' . $reservation->city . '<br>
     <dl ">
        <dt> Téléphone </dt>
        <dd>' . $user->phone . '</dd>
        <dt> Courriel   </dt>
        <dd> ' . $user->mail . '</dd>
        </dl>
<table>
  <thead>
  <tbody>
    <tr> 
      <th style="padding-right:20px;"> Date de départ</th>
      <th style="margin-right:20px;"> Date de retour</th>
      <th> Montant </th>
    </tr>
  
    <tr>
      <td> ' . ucfirst($formatDateFr->format(strtotime($reservation->rental_date)))  . ' </td>
      <td> ' . ucfirst($formatDateFr->format(strtotime($reservation->return_date)))  . ' </td>
      <td> ' . $reservationVehicle->price . ' €/nuit</td>
    </tr>
    </tbody>
      </thead>
      </table>
  
<footer>
 <p> VAN LIFE| <a href="http://joseroux.com">VANLIFE-Amiens.com</a> </p>
  <p> 1777 some street in the woods, Wentworth-Nord, Qc, J0T 1Y0 | Tél. 450-555-1000 | <a href="mailto:mail@me.com">mail@me.com</a> </p>
</footer>    
    ');
}

//DIMENSION DE LA FACTURE
$dompdf->setPaper('A4', 'portrait');

//Mettre le HTML AU FORMAT PDF
$dompdf->render();

//NOM DU FICHIER
$file = ('facture.pdf');

//EXPORTER LE PDF VERS LE NAVIGUATEUR
$dompdf->stream('facture.pdf');

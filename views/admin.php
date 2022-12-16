<main class="dashboardAdmin container mt-5">

    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/admin/create/addVehicleAdminCtrl.php">Création vehicule</a></button>
    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/admin/create/addUserAdminCtrl.php">Création client</a></button>
    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/admin/create/addAgencieAdminCtrl.php">Création Agence</a></button>

    <h1 class="mb-5">Bienvenue <?= ($_SESSION['user']->firstname) ?></h1>

    <div class="message mb-3 fs-5">
        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>
    </div>


    <!-- Utilisateur -->
    <div class="card mb-3">
        <table class="userDashboardAdmin table table-hover table-sm col-12 mb-5">
            <h2 class=" mb-2 mt-3">Utilisateurs</h2>

            <thead>
                <tr>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Nom</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Prénom</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Date de naissance</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Adresse</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Téléphone</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">E-mail</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Role</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Créé le</th>
                    <th class="text-uppercase text-center fw-bold fs-6 col-1" scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <?php foreach ($users as $user) { ?>
                <tbody>
                    <tr>
                        <td class="text-center" class="text-center"><?= $user->lastname ?></td>
                        <td class="text-center" class="text-center"><?= $user->firstname ?></td>
                        <td class="text-center" class="text-center"><?= $user->birthdate ?></td>
                        <td class="text-center" class="text-center"><?= $user->adress ?></td>
                        <td class="text-center" class="text-center"><?= $user->phone ?></td>
                        <td class="text-center" class="text-center"><?= $user->mail ?></td>
                        <td class="text-center" class="text-center"><?= $user->role ?></td>

                        <td><?= ucfirst($formatDateFr->format(strtotime($user->created_at))) ?? '' ?></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/modification-utilisateur?id=<?= $user->id_users ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteUserCtrl.php?id=<?= $user->id_users  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                        
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <!-- Véhicule -->
    <div class="card mb-3">
        <table class="vehicleDashboardAdmin table table-hover table-sm col-12 mb-5">
            <h2 class="mb-2 mt-2">Van</h2>

            <thead>
                <tr>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Marque</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Description</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Prix</th>
                    <th class="text-uppercase text-center fw-bold fs-6 col-1" scope="col" colspan="2">Action</th>
                </tr>
            </thead>

            <?php foreach ($vehicles as $vehicle) { ?>
                <tbody>
                    <tr>
                        <td class="text-center"><?= $vehicle->name ?></td>
                        <td class="text-center"><?= $vehicle->description ?></td>
                        <td class="text-center"><?= $vehicle->price ?> €</td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/modification-vehicule?id=<?= $vehicle->id_vehicles ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteVehicleCtrl.php?id=<?= $vehicle->id_vehicles  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                    </tr>
                </tbody>

            <?php } ?>
        </table>
    </div>


    <!-- Agence -->
    <div class="card mb-3">
        <table class="agencieDashboardAdmin table table-hover table-sm col-12  mb-5 ">
            <h2 class="mb-2 mt-2">Agences</h2>
            <thead>
                <tr>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Nom</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Adresse</th>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col">Description</th>
                    <th class="text-uppercase text-center fw-bold fs-6" colspan="2" scope="col">Action</th>
                </tr>
            </thead>

            <?php foreach ($agencies as $agencie) { ?>
                <tbody>
                    <tr>
                        <td class="text-center"><?= $agencie->name ?></td>
                        <td class="text-center"><?= $agencie->adress ?></td>
                        <td class="text-center"><?= $agencie->description ?></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/modification-agence?id=<?= $agencie->id_agencies ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteAgencieCtrl.php?id=<?= $agencie->id_agencies  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                    </tr>
                </tbody>

            <?php } ?>
        </table>
    </div>

    <div class="card mb-3">
        <table class="userDashboardAdmin table table-hover table-sm col-12 mb-5  ">
            <h2 class=" mt-2">Reservations</h2>
            <thead>
                <tr>
                    <td class="text-uppercase text-center fw-bold fs-6" scope="col">Nom</td>
                    <td class="text-uppercase text-center fw-bold fs-6" scope="col">Prénom</td>
                    <td class="text-uppercase text-center fw-bold fs-6" scope="col">Date de départ</td>
                    <td class="text-uppercase text-center fw-bold fs-6" scope="col">Date de retour</td>
                    <td class="text-uppercase text-center fw-bold fs-6" scope="col">Véhicule</td>
                    <td class="text-uppercase text-center fw-bold fs-6" scope="col">Agence</td>
                    <th class="text-uppercase text-center fw-bold fs-6" scope="col" colspan="3">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($userLocation as $reservation) { ?>
                    <tr>
                        <td class="text-center"><?= $reservation->lastname ?></td>
                        <td class="text-center"><?= $reservation->firstname ?></td>
                        <td class="text-center"><?= ucfirst($formatDateFr->format(strtotime($reservation->rental_date))) ?? '' ?></td>
                        <td class="text-center"><?= ucfirst($formatDateFr->format(strtotime($reservation->return_date))) ?? '' ?></td>
                        <td class="text-center"><?= $reservation->vehicle_name ?></td>
                        <td class="text-center"><?= $reservation->name ?></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/modif-location-utilisateur-by-admin?id=<?= $reservation->id_registers ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteLocationCtrl.php?id=<?= $reservation->id_registers  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                        <td class="text-center"><a class="text-decoration-none text-dark" href="/controllers/facturepdfCtrl.php?id=<?= $reservation->id_registers ?>"><ion-icon name="folder-outline"></ion-icon></a></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
    </div>


</main>
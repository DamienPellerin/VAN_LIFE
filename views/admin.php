<main class="dashboardAdmin container mt-5">

    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/admin/create/addVehicleAdminCtrl.php">Création vehicule</a></button>
    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/admin/create/addUserAdminCtrl.php">Création client</a></button>
    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/admin/create/addAgencieAdminCtrl.php">Création Agence</a></button>

    <h1 class="mb-5">Bienvenue <?= ($_SESSION['user']->firstname) ?></h1>
    <?php if (SessionFlash::exist()) { ?>
        <?= SessionFlash::get(); ?>
    <?php } ?>
    <div class="row">
        <h2 class="mb-3">Utilisateurs</h2>
        <!-- Utilisateur -->
        <table class="userDashboardAdmin table table-hover table-bordered table-sm col-12 mb-5">
            <thead>
                <tr>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Nom</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Prénom</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Date de naissance</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Adresse</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Téléphone</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">E-mail</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Role</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Créé le</th>
                    <th class="text-uppercase text-center fw-bold fs-5 " scope="col">Action</th>
                </tr>
            </thead>
            <?php foreach ($users as $user) { ?>
                <tbody>
                    <tr>
                        <td><?= $user->lastname ?></td>
                        <td><?= $user->firstname ?></td>
                        <td><?= $user->birthdate ?></td>
                        <td><?= $user->adress ?></td>
                        <td><?= $user->phone ?></td>
                        <td><?= $user->mail ?></td>
                        <td><?= $user->role ?></td>
                        
                        <td><?= ucfirst($formatDateFr->format(strtotime($user->created_at ))) ?? '' ?></td>
                        <td><a class="text-decoration-none text-dark" href="/modification-utilisateur?id=<?= $user->id_users ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteUserCtrl.php?id=<?= $user->id_users  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>

        <h2 class="mb-3">Van</h2>
        <!-- Véhicule -->
        <table class="vehicleDashboardAdmin table table-hover table-bordered table-sm col-12 mb-5">
            <thead>
                <tr>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Marque</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Description</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Prix</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Action</th>
                </tr>
            </thead>

            <?php foreach ($vehicles as $vehicle) { ?>
                <tbody>
                    <tr>
                        <td><?= $vehicle->name ?></td>
                        <td><?= $vehicle->description ?></td>
                        <td><?= $vehicle->price ?> €</td>
                        <td><a class="text-decoration-none text-dark" href="/modification-vehicule?id=<?= $vehicle->id_vehicles ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteVehicleCtrl.php?id=<?= $vehicle->id_vehicles  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                    </tr>
                </tbody>

            <?php } ?>
        </table>
        <h2 class="mb-3">Agences</h2>
        <!-- Agence -->
        <table class="agencieDashboardAdmin table table-hover table-bordered table-sm col-12  mb-5">
            <thead>
                <tr>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Nom</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Adresse</th>
                    <th class="text-uppercase text-center fw-bold fs-5" scope="col">Description</th>
                </tr>
            </thead>

            <?php foreach ($agencies as $agencie) { ?>
                <tbody>
                    <tr>
                        <td><?= $agencie->name ?></td>
                        <td><?= $agencie->adress ?></td>
                        <td><?= $agencie->description ?></td>
                        <td><a class="text-decoration-none text-dark" href="/modification-agence?id=<?= $agencie->id_agencies ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteAgencieCtrl.php?id=<?= $agencie->id_agencies  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                    </tr>
                </tbody>

            <?php } ?>
        </table>

        <h2 class="mb-3">Reservations</h2>
        <table class="userDashboardAdmin table table-hover table-bordered table-sm col-12 mb-5 mt-5 ">
            <thead>
                <tr>
                    <td class="text-uppercase text-center fw-bold fs-5" scope="col">Nom</td>
                    <td class="text-uppercase text-center fw-bold fs-5" scope="col">Prénom</td>
                    <td class="text-uppercase text-center fw-bold fs-5" scope="col">Date de départ</td>
                    <td class="text-uppercase text-center fw-bold fs-5" scope="col">Date de retour</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($userLocation as $reservation) { ?>
                    <tr>
                        <td><?= $reservation->lastname ?></td>
                        <td><?= $reservation->firstname ?></td>
                        <td><?= ucfirst($formatDateFr->format(strtotime($reservation->rental_date))) ?? '' ?></td>
                        <td><?= ucfirst($formatDateFr->format(strtotime($reservation->return_date))) ?? '' ?></td>

                        <td><a class="text-decoration-none text-dark" href="/modif-location-utilisateur-by-admin?id=<?= $reservation->id_registers ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td><a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteLocationCtrl.php?id=<?= $reservation->id_registers  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>


</main>
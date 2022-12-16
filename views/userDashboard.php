<main class=" container mt-5">

    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/modif-utilisateur">Modification de votre compte</a></button>
    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/deleteUserCtrl.php">Supprimer votre compte</a></button>
    <button class="btn btn-dark mb-4" type="button"><a class="text-decoration-none text-light" href="/controllers/user/create/addCommentUserCtrl.php">Ajouter un commentaire</a></button>

    <h1 class="mb-5">Bienvenue <?= ($_SESSION['user']->firstname) ?></h1>

    <div class="userDashboard">
        
        <div class="message mb-3 fs-5">
            <?php if (SessionFlash::exist()) { ?>
                <?= SessionFlash::get(); ?>
            <?php } ?>
        </div>

        <div class="card mb-3">
            <table class="userDashboardAdmin table table-sm col-12  mt-5 ">
                <h2 class="  mt-3">Vos informations</h2>
                <thead>
                    <tr>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Nom</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Prénom</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Mail</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Date de naissance</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Ville</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Adresse</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Téléphone</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Code postale</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Créé le</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><?= ($_SESSION['user']->lastname) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->firstname) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->mail) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->birthdate) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->city) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->adress) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->phone) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->zipcode) ?></td>
                        <td class="text-center"><?= ($_SESSION['user']->created_at) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card mb-3">
            <table class="userDashboardAdmin table table-sm col-12 mb-3 mt-5 ">
                <h2 class="  mt-3">Vos reservations</h2>
                <thead>
                    <tr>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Date de départ</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Date de retour</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Vehicule</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" scope="col">Agence</td>
                        <td class="text-uppercase fw-bold fs-5 text-center" colspan="3" scope="col">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userLocation as $reservation) { ?>
                        <tr>
                            <td class="text-center"><?= ucfirst($formatDateFr->format(strtotime($reservation->rental_date))) ?? '' ?></td>
                            <td class="text-center"><?= ucfirst($formatDateFr->format(strtotime($reservation->return_date))) ?? '' ?></td>
                            <td class="text-center"><?= $reservation->vehicle_name ?></td>
                            <td class="text-center"><?= $reservation->name ?></td>
                            <td class="text-center"><a class="text-decoration-none text-dark" href="/modif-location-utilisateur?id=<?= $reservation->id_registers ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                            <td class="text-center"><a class="text-decoration-none text-dark" href="/controllers/user/delete/deleteLocationCtrl.php?id=<?= $reservation->id_registers ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                            <td class="text-center"><a class="text-decoration-none text-dark" href="/controllers/facturepdfCtrl.php?id=<?= $reservation->id_registers ?>"><ion-icon name="folder-outline"></ion-icon></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
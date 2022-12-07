<main class=" container">

    <button class="btn btn-dark" type="button"><a class="text-decoration-none text-light" href="/modif-utilisateur">Modification de votre compte</a></button>
    <button class="btn btn-dark" type="button"><a class="text-decoration-none text-light" href="/controllers/deleteUserCtrl.php">Supprimer votre compte</a></button>

    <h1>Bienvenue <?= ($_SESSION['user']->firstname) ?></h1>
    
    <div class="userDashboard">

        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>

        <table class="userDashboardAdmin table table-sm col-12 mb-3 mt-5 ">
            <thead>
                <tr>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Nom</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Prénom</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Mail</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Date de naissance</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Ville</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Adresse</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Téléphone</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Code postale</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Créé le</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= ($_SESSION['user']->lastname) ?></td>
                    <td><?= ($_SESSION['user']->firstname) ?></td>
                    <td><?= ($_SESSION['user']->mail) ?></td>
                    <td><?= ($_SESSION['user']->birthdate) ?></td>
                    <td><?= ($_SESSION['user']->city) ?></td>
                    <td><?= ($_SESSION['user']->adress) ?></td>
                    <td><?= ($_SESSION['user']->phone) ?></td>
                    <td><?= ($_SESSION['user']->zipcode) ?></td>
                    <td><?= ($_SESSION['user']->created_at) ?></td>
                </tr>
            </tbody>
        </table>

        <table class="userDashboardAdmin table table-sm col-12 mb-3 mt-5 ">
            <thead>
                <tr>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Date de départ</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Date de retour</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Vehicule</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col">Agence</td>
                    <td class="text-uppercase fw-bold fs-5" scope="col"></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userLocation as $reservation) { ?>
                    <tr>
                   
                        <td><?= ucfirst ($formatDateFr->format(strtotime($reservation->rental_date))) ?? '' ?></td>
                        <td><?= ucfirst ($formatDateFr->format(strtotime($reservation->return_date))) ?? '' ?></td>
                        <td></td>

                        <td><a class="text-decoration-none text-dark" href="/modif-location-utilisateur?id=<?= $reservation->id_registers ?>"><img src="/public/assets/img/edit.svg" alt=""></a></td>
                        <td><a class="text-decoration-none text-dark" href="/controllers/user/delete/deleteLocationCtrl.php?id=<?= $reservation->id_registers ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</main>
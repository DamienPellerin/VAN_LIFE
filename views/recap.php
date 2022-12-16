<main class=" justify-content-center">
    <?php if (SessionFlash::exist()) { ?>
        <?= SessionFlash::get(); ?>
    <?php } ?>
    <section class=" row justify-content-center">
        <h1 class="mb-5">Récapitulatif de votre location</h1>

        <div class="facture card col-8">
            <div class="info">
                <div class="info-user">
                    <div class="recap">Agence de <?= $agencie->name ?></div>
                    <div class="recap"><?= $agencie->adress ?></div>
                    <div class="recap"><?= $agencie->zipcode ?> <?= $agencie->city ?></div>
                </div>

                <div class="info-agencie">
                    <div class="recap"><?= $user->lastname ?> <?= $user->firstname ?></div>
                    <div class="recap"><?= $user->adress ?></div>
                    <div class="recap"><?= $user->zipcode ?> <?= $user->city ?></div>
                </div>
            </div>


            <div class="row  justify-content-center mb-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">N°Client</th>
                            <th scope="col">Agence</th>
                            <th scope="col">Départ</th>
                            <th scope="col">Retour</th>
                            <th scope="col">Vehicule</th>
                            <th scope="col">Prix</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th><?= $user->id_users ?></th>
                            <td><?= $agencie->name ?></td>
                            <td><?= ucfirst($formatDateFr->format(strtotime($dateDeparture))) ?></td>
                            <td><?= ucfirst($formatDateFr->format(strtotime($dateReturn))) ?></td>
                            <td><?= $vehicle->name ?></td>
                            <td><?= $vehicle->price ?>€/nuit</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p>Merci de votre confiance.<br>Nous vous souhaitons un excellent road trip</p>
        </div>
        
    </section>

    <form method="POST" class="row justify-content-center ">
        <input type="hidden" value="1" name="validate">
        <button type="submit" class="btn btn-dark col-3 mt-3 mb-5">Paiement</button>
    </form>
</main>
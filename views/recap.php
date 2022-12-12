<main class=" justify-content-center">
    <?php if (SessionFlash::exist()) { ?>
        <?= SessionFlash::get(); ?>
    <?php } ?>
    <section class="recap">
        <h1 class="mb-5">Récapitulatif de votre location</h1>
        <div class="row justify-content-center mb-3">
            <ul class="text-center">
                <li>Agence de départ : <?= $agencie->name ?></li>
                <li>Date de départ : <?= ucfirst($formatDateFr->format(strtotime($dateDeparture))) ?></li>
                <li>Date de retour : <?= ucfirst($formatDateFr->format(strtotime($dateReturn))) ?></li>
                <li> Vehicule choisi : <?= $vehicle->name ?></li>
            </ul>
        </div>
    </section>

    <form  method="POST" class="row justify-content-center">
        <input type="hidden" value="1" name="validate">
        <button type="submit" class="btn btn-dark col-3 mt-3">Paiement</button>
    </form>
</main>
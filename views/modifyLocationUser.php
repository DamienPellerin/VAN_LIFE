<main >

    <h1 class="mt-5">Modification de votre location</h1>

    <div class="modifyUserLocation container">

        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>

        <form method="POST" id="form" class="row justify-content-center mt-5">
            <div class="row justify-content-center mt-5">
                <div class="row col-4">
                    <label for="agencie">Agence</label>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="agencie" id="agencie">
                        <option selected>Agence</option>
                        <?php foreach ($agencies as $agencie) { ?>
                            <option <?= ($reservation->id_agencies == $agencie->id_agencies) ? 'selected' : ''; ?> value="<?= $agencie->id_agencies ?>"><?= $agencie->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="row col-4">
                    <label for="vehicle">Vehicule</label>
                    <select class="form-select form-select-sm " aria-label=".form-select-sm example" name="vehicle" id="vehicle">
                        <option selected>Vehicule</option>
                        <?php foreach ($vehicles as $vehicle) { ?>
                            <option <?= ($reservation->id_vehicles == $vehicle->id_vehicles) ? 'selected' : ''; ?> value="<?= $vehicle->id_vehicles ?>"><?= $vehicle->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="row col-4">
                    <label for="departure">Date de départ</label>
                    <input type="date" class="form-control" id="departure" name="departure" value="<?= date('Y-m-d', strtotime($reservation->rental_date))  ?>">
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="row col-4">
                    <label for="return">Date de retour</label>
                    <input type="date" class="form-control" id="return" name="return" value="<?= date('Y-m-d', strtotime($reservation->return_date))  ?>">
                </div>
            </div>
    </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-4 text-center">
            <button type="submit" class="btn btn-dark">Modifier</button>
        </div>
    </div>
    </form>
    </div>
</main>
<main class=" container justify-content-server h-100">

    <h1>Modification de votre location</h1>

    <div class="modifyUserLocation container">

        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>

        <form method="POST" id="form" class="container justify-content-center ">

            <div class="row col-6">
                <label for="agencie">Agence</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="agencie" id="agencie">
                    <option selected>Agence</option>
                    <?php foreach ($agencies as $agencie) { ?>
                        <option <?= ($reservation->id_agencies == $agencie->id_agencies) ? 'selected' : ''; ?> value="<?= $agencie->id_agencies ?>"><?= $agencie->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="row col-6">
                <label for="vehicle">Vehicule</label>
                <select class="form-select form-select-sm " aria-label=".form-select-sm example" name="vehicle" id="vehicle">
                    <option selected>Vehicule</option>
                    <?php foreach ($vehicles as $vehicle) { ?>
                        <option <?= ($reservation->id_vehicles == $vehicle->id_vehicles) ? 'selected' : ''; ?> value="<?= $vehicle->id_vehicles ?>"><?= $vehicle->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="row  col-6">
                <label for="departure">Date de départ</label>
                <input type="date" class="form-control" id="departure" name="departure" value="<?= date('Y-m-d', strtotime($reservation->rental_date))  ?>">
            </div>

            <div class="row justify-content-center col-6">

                <label for="return">Date de retour</label>
                <input type="date" class="form-control" id="return" name="return" value="<?= date('Y-m-d', strtotime($reservation->return_date))  ?>">
            </div>
    </div>
    </div>
    </form>

    <div class="col-12 justify-content-center mt-5 mb-5">
        <button type="submit" class="btn btn-dark">Modifier</button>
    </div>

    </form>
    </div>
</main>
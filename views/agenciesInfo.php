<main>
    <section class="city">
        <?php foreach ($agencies as $agencie) { ?>
            <?php if ($agencie->id_agencies  == $agencieId) { ?>

                <section class="img-agencie-card">
                    <img class="img-card-agencie mt-5" src="../public/uploads/agencies/<?= $agencie->id_agencies ?>.jpg" alt="...">
                </section>

                <div class="row justify-content-center mt-3">
                    <h1 class="mb-3">Louer un van aménagé à <?= $agencie->name ?></h1>
                    <p class="description text-center mb-5"><?= $agencie->description ?></p>
                </div>
                <section class="container col-12 mb-5">

                    <div class="form-select-agencie row justify-content-center mb-3">
                        <div class="col-3 row justify-content-center">
                            <label for="agencie">Agence</label>
                            <select class="form-select form-select-sm " aria-label=".form-select-sm example" name="agencie" id="agencie" required>
                                <option value="<?= $agencie->id_agencies ?>"><?= $agencie->name ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-3">
                            <label for="departure">Date de départ</label>
                            <input type="date" class="form-control" id="departure" name="departure" value="<?= $dateDeparture ?>" required>
                        </div>
                        <div class="col-3">
                            <label for="return">Date de retour</label>
                            <input type="date" class="form-control" id="return" name="return" value="<?= $dateReturn ?>" required>
                        </div>
                    </div>
                </section>

            <?php } ?>
        <?php } ?>
    </section>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <?php foreach ($vehicles as $vehicle) { ?>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <h2 class="name"><?= $vehicle->name ?></a></h2>
                            <img class="card-img-vehicle" src="../public/uploads/vehicles/<?= $vehicle->id_vehicles ?>.jpg" alt="...">
                        </div>

                        <div class="card-content">

                            <p class="description"><?= $vehicle->description ?></p>
                            <p class="description"><?= $vehicle->price ?> €/nuit</p>

                            <?php if ((isset($_SESSION['user']))) { ?>
                                <button class="button vehicleBtn" id="<?= $vehicle->id_vehicles ?>"> Réserver </button>
                            <?php } else { ?>
                                <button class="button"><a class="text-light text-decoration-none" href="http://van_life.localhost/controllers/connectionController.php">Réserver</a> </button>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    </div>
    <section class=" row justify-content-center">
        <h2 class="mb-3">Tu peux récupérer ton véhicule ici</h2>

        <iframe class="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2570.374185812611!2d2.2899733156720927!3d49.89177793534213!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e784402170ed13%3A0x61fd096ace4defb3!2s5%20Rue%20du%20Mar%C3%A9chal%20de%20Lattre%20de%20Tassigny%2C%2080000%20Amiens!5e0!3m2!1sfr!2sfr!4v1670487163172!5m2!1sfr!2sfr"></iframe>
    </section>
</main>
<script src="../public/assets/js/reserveByVehicle.js"></script>
<main>
    <section class="city">
        <?php foreach ($vehicles as $vehicle) { ?>
            <?php if ($vehicle->id_vehicles  == $vehicleId) { ?>

                <section class="img-agencie-card">
                   <img class="img-card-vehicle mt-5" src="../public/uploads/vehicles/<?= $vehicle->id_vehicles ?>.jpg" alt="...">
                   <div class="options"></div>
                </section>

                <div class="row justify-content-center mt-3">
                    <h1>Louer le van <?= $vehicle->name ?></h1>
                    <p class="text-center"><?= $vehicle->description ?></p>
                </div>
                
                <section class="container mb-5 ">

                    <div class="row justify-content-center mb-3 ">
                        <div class="col-6 ">
                            <label for="vehicle">Van</label>
                            <select class="form-select form-select-sm " aria-label=".form-select-sm example" name="vehicle" id="vehicle">
                                <option value="<?= $vehicle->id_vehicles ?>"><?= $vehicle->name ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3 ">
                        <div class="col-6">
                            <label for="departure">Date de départ</label>
                            <input type="date" class="form-control" id="departure" name="departure" value="<?= $dateDeparture ?>" required>
                        </div>
                        <div class="col-6">
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
                <?php foreach ($agencies as $agencie) { ?>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <h2 class="name"><?= $agencie->name ?></h2>
                            <img class="card-img-agencie" src="../public/uploads/agencies/<?= $agencie->id_agencies ?>.jpg" alt="...">
                        </div>

                        <div class="card-content">
                        
                            <?php if ((isset($_SESSION['user']))) { ?>
                                <button class="button agencieBtn" id="<?= $agencie->id_agencies ?>"> Réserver </button>
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
</main>
<script src="../public/assets/js/reserveByAgencie.js"></script>
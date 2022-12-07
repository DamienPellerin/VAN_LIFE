<main>

    <!-- VEHICULES -->
    <section class="all-vehicles">
        <h1>Disponibilité à la location</h1>
        <div class="line-title"><span class="line-span"></span></div>
        <h2>Là où commence ton voyage !</h2>
        <p>Vanlife propose des vans aménagés à la location en France. Découvre dès maintenant la liste de nos agences et réserve ton van ou fourgon aménagé dans l’agence vanlife la plus proche de ton domicile ou de ton lieu de départ.</^>
    </section>

    <section class="container col-6 mb-5">

        <div class="row justify-content-center mb-3">
            <div class="col-8">
                <label for="agencie">Agence</label>
                <select class="form-select form-select-sm " aria-label=".form-select-sm example" name="agencie" id="agencie">
                    <option><?= $agencie->name ?></option>
                </select>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4">
                <label for="departure">Date de départ</label>
                <input type="date" class="form-control" id="departure" name="departure" value="<?= $dateDeparture ?>">
            </div>
            <div class="col-4">
                <label for="return">Date de retour</label>
                <input type="date" class="form-control" id="return" name="return" value="<?= $dateReturn ?>">
            </div>
        </div>

    </section>

    <section class="two">
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <?php foreach ($vehicles as $vehicle) { ?>
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <span class="overlay"></span>

                                <div class="card-image">
                                    <img class="card-img-agencie" src="../public/uploads/vehicles/<?= $vehicle->id_vehicles ?>.jpg" alt="...">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name"><a href="../controllers/vehicleInfoController.php?id=<?= $vehicle->id_vehicles ?>"><?= $vehicle->name ?></a></h2>
                                <p class="description"><?= $vehicle->description ?></p>

                                <button class="button"><a href="/controllers/recapCtrl.php?vehicle=<?= $vehicle->id_vehicles ?>&agencie=<?= $agencie->id_agencies ?>&departure=<?= $dateDeparture ?>&return=<?= $dateReturn ?>" class="btn-contact">Réserver</a></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
</main>
<main>
    <section class="all-vehicles">
        <h1 class="mb-3 mt-5">NOS VEHICULES VAN LIFE</h1>
        <div class="line-title"><span class="line-span"></span></div>
        <h2>Là où commence ton voyage !</h2>
        <p>Vanlife propose des vans aménagés à la location en France. Découvre dès maintenant la liste de nos agences et réserve ton van ou fourgon aménagé dans l’agence vanlife la plus proche de ton domicile ou de ton lieu de départ.</^>
    </section>

    <!--<img src="../public/assets/img/roadsurfer-beach-hostel-deluxe-sideview.jpeg" alt="...">-->
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                    <?php foreach ($vehicles as $vehicle) { ?>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>

                            <div class="card-image">
                            <img class="card-img-agencie" src="../public/uploads/vehicles/<?=$vehicle->id_vehicles?>.jpg" alt="...">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name"><a href="../controllers/vehicleInfoController.php?id=<?= $vehicle->id_vehicle ?>"><?= $vehicle->name ?></a></h2>
                            <p class="description"><?= $vehicle->description ?></p>

                            <button class="button">Decouvrir</button>
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
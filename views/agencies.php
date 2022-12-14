<main>
    <section class="all-agencies">
        <h1 class="mb-3 mt-5">NOS AGENCES VAN LIFE</h1>
        <div class="line-title"><span class="line-span"></span></div>
        <h2>Là où commence ton voyage !</h2>
        <p class="description text-center">Vanlife propose des vans aménagés à la location en France. Découvre dès maintenant la liste de nos agences et réserve ton van ou fourgon aménagé dans l’agence vanlife la plus proche de ton domicile ou de ton lieu de départ.</^>
    </section>
    <!--<img src="../public/assets/img/roadsurfer-beach-hostel-deluxe-sideview.jpeg" alt="...">-->
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <?php foreach ($agencies as $agencie) { ?>
                    <div class="card swiper-slide">
                        <div class="image-content">
                        <h2 class="name"><?= $agencie->name ?></h2>
                        <span class="lines"></span>
                            <img class="card-img-agencie" src="../public/uploads/agencies/<?= $agencie->id_agencies ?>.jpg" alt="...">
                        </div>

                        <div class="card-content">
                            <button class="button"><a href="../controllers/agenciesInfoController.php?id=<?= $agencie->id_agencies ?>" > Decouvrir</a></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination "></div>
    </div>

</main>
<main>

        <div class="hero-banner">
            <!--HEADER-MODAL-RESERVATION-->
            <div class="reserve container  col-5 mt-5">
                <div class=" card col-9 mt-5">
                    <h3 class="text-center mt-2">Loue un van amenagé</h3>
                    <div class="card-body">
                        <div class="quicksearch-form">
                            <form action="/controllers/reservationCtrl.php" method="GET">
                                <label for="agencie">Agence</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="agencie" id="agencie">
                                    <option selected>Agence</option>
                                    <?php foreach ($agencies as $agencie) { ?>
                                        <option value="<?= $agencie->id_agencies ?>"><?= $agencie->name ?></option>
                                    <?php } ?>
                                </select>
                                <div class="row">
                                    <div class="col">
                                        <label for="departure">Date de départ</label>
                                        <input type="date" class="form-control" id="departure" name="departure">
                                    </div>
                                    <div class="col">
                                        <label for="return">Date de retour</label>
                                        <input type="date" class="form-control" id="return" name="return">
                                    </div>
                                    <button type="submit" class="btn btn-dark col-5 mt-3">Voir les tarifs</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>
        <div class="presentation">
            <h1 class="mt-5">L'ESPRIT VAN LIFE</h1>
            <div class="line"></div>
            <div class="paragraph-A">
                <p>
                    Laissez nous deviner…
                    Vous avez envie de vous évader le temps d’un week-end, d’une semaine… ou de partir en road trip en
                    France ou méme en Europe, plus longtemps encore ?
                    Vous êtes en quête d’originalité, de différence… de nouveauté ? Vous aspirez à l’imprévu, à
                    l’aventure…
                    à la liberté ?
                    Avez-vous pensé à la location d’un van aménagé (ou campervan)? À un road trip à bord d’un véhicule
                    totalement autonome, combi California à toit relevable ou fourgon aménagé, pour découvrir une
                    nouvelle
                    forme de liberté et de voyage?
                    Bienvenue chez VAN LIFE, spécialiste des vacances itinérantes et séjours nomades!
                </p>
            </div>
        </div>
    </section>
    <section>
        <div class="cards">
            <div class="card-agency">
                <a class="agency" href="/controllers/agenciesController.php"> Nos Agences</a>
                <div class="A"></div>
            </div>

            <div class="card-vehicle">
                <a class="vehicle" href="/controllers/vehiclesController.php">Nos Vehicules</a>
                <div class="B"></div>
            </div>

            <div class="card-adventure">
                <a class="adventure">Vos Aventures</a>
                <div class="C"></div>
            </div>
        </div>
    </section>

    <!--<section>
        <div class="serenity">
            <h2>Les avantages Van Life</h2>
            <div class="line"></div>
            <div class="paragraph-B">
                <p> Van Life est le spécialiste Outdoor ! Nous prônons la liberté, l’aventure et la flexibilité et nous voulons que tu vives exactement ce type d’expérience avec nous ! Profite d’un maximum de flexibilité lors de ton voyage,
                    des meilleurs vans au meilleur prix et d’un voyage en camping inoubliable – du début à la fin, sans souci et sans frais cachés.
                </p>
            </div>
            <div class="ligne"><span class="line-span"></span></div>
            <div class="advantages">
                <div class="assurance">
                    <img class="axa" src="../public/assets/img/axa.png" alt="assurance">
                    <p><strong>Un voyage serein</strong></p>
                    <p>"Location assurée par Axa"</p>
                </div>
                <div class="conducteur">
                    <img class="second-conducteur" src="../public/assets/img/conducteur.png" alt="second-conducteur">
                    <p><strong>2éme conducteur</strong></p>
                    <p>"Inclus"</p>
                </div>
                <div class="kilometrage">
                    <img class="km" src="../public/assets/img/kilometrage.png" alt="kilometrage">
                    <p><strong>Oubliez les kilometres</strong></p>
                    <p>"Kilometrage illimités"</p>
                </div>
                <div class="assistance">
                    <img class="depannage" src="../public/assets/img/depannage.png" alt="depannage">
                    <p><strong>Aucun tracas</strong></p>
                    <p>"Assistance 24/24 7/7"</p>
                </div>
            </div>
            <div class="all-advantages">
                <button><a href="../controllers/allAdvantagesController.php">Découvre tous tes avantages</a></button>
            </div>
            <div class="ligne"><span class="line-span"></span></div>
    </section>

    <h2 class="title-carousel">Nos modèles VANLIFE</h2>
    <div class="line"><span class="line-span"></span></div>

     VEHICULES 
    <section>
        <div class="row row-cols-2 row-cols-md-3 g-5 m-3">
            <?php foreach ($vehicles as $vehicle) { ?>
                <div class="col">
                    <div class="card">
                        <img src="../public/assets/img/roadsurfer-surfer-suite-sideview.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $vehicle->name ?></h5>
                            <p class="card-text"><?= $vehicle->description ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <div class="row justify-content-center">
        <p class="modeles">Les tarifs communiqués sont à titre indicatif et peuvent varier selon la période à laquelle tu voyages, la durée de location et l’agence depuis laquelle tu pars. D’une manière générale, le plus tôt tu réserves, le plus bas sera le prix.</p>

        <button type="submit" class="btn btn-dark col-3 m-3"><a href="../controllers/vehiclesController.php">Découvre tous nos modèles</a></button>
    </div>

    <div class="ligne"><span class="line-span"></span></div>

    <h2 class="title-carousel">Nos Agences VANLIFE</h2>
    <div class="line"><span class="line-span"></span></div>

     AGENCES 

    <section>
        <div class="row row-cols-2 row-cols-md-3 g-5 m-3">
            <?php foreach ($agencies as $agencie) { ?>
                <div class="col">
                    <div class="card">
                        <img src="../public/assets/img/amiens.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $agencie->name ?></h5>
                            <p class="card-text"><?= $agencie->description ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <div class="row justify-content-center">
        <button type="submit" class="btn btn-dark col-3 m-3"><a href="../controllers/agenciesController.php">Découvre toutes nos agences</a></button>
    </div>

    <div class="ligne"><span class="line-span"></span></div>-->

</main>
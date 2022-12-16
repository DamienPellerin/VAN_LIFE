<main>
    <div class="hero-banner">
        <!--HEADER-MODAL-RESERVATION-->
        <div class="reserve container  col-5 mt-5 sm">
            <div class=" card-reserve card col-9 mt-5">
                <h3 class="text-center mt-2">Loue un van amenagé</h3>
                <div class="card-body">
                    <div class="quicksearch-form">
                        <form action="/controllers/reservationCtrl.php" method="GET">
                            <label for="agencie">Agence</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="agencie" id="agencie" required>
                                <option selected>Votre agence</option>
                                <?php foreach ($agencies as $agencie) { ?>
                                    <option value="<?= $agencie->id_agencies ?>"><?= $agencie->name ?></option>
                                <?php } ?>
                            </select>
                            <div class="row">
                                <div class="col">
                                    <label for="departure">Date de départ</label>
                                    <input type="date" class="form-control" id="departure" name="departure" required>
                                </div>
                                <div class="col">
                                    <label for="return">Date de retour</label>
                                    <input type="date" class="form-control" id="return" name="return" required>
                                </div>
                                <?php if ((!isset($_SESSION['user']))) { ?>
                                    <button type="submit" class="btn btn-dark col-5 mt-3"><a class="text-light text-decoration-none" href="http://van_life.localhost/controllers/connectionController.php">Réserver</a></button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-dark col-5 mt-3">Réserver</button>
                                <?php } ?>
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
                <a class="adventure" href="../controllers/adventuresCtrl.php">Vos Aventures</a>
                <div class="C"></div>
            </div>
        </div>
    </section>
    <section>

        <div class="liberty">
            <div class="liberty-card">
                <p class="liberty-van">"Une liberté sans limites ..."</p>
                <div class="picture-liberty"></div>
            </div>
        </div>
        </div>
    </section>
</main>
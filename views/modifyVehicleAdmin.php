<main class=" container">

    <h1>Modification d'un vehicule</h1>

    <div class="modifyVehicle">
        <form method="POST" id="form" >

            <?php if (SessionFlash::exist()) { ?>
                <?= SessionFlash::get(); ?>
            <?php } ?>

            <div class="row justify-content-center mt-5">

                <!--NOM-->
                <div class="col-md-5 mb-3">
                    <div class="errorName"><?= $error['name'] ?? '' ?></div>
                    <label for="name" class="form-label">Nom du véhicule</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="NOM DU VEHICULE" value="<?= $name ?? '' ?>" autocomplete="name" required>
                </div>

                <!--PRIX DU VAN-->
                <div class="col-md-5 ">
                    <div class="error"><?= $error['price'] ?? '' ?></div>
                    <label for="price" class="form-label">Prix</label>
                    <input class="form-control" id="price" name="price" placeholder="prix" value="<?= $price ?? '' ?>" pattern="<?= REGEX_NUMBER ?>" autocomplete="description" required>
                </div>

                <!--DESCRIPTION-->
                <div class="col-md-5 mt-3">
                    <div class="errorDescription"><?= $error['description']  ?? '' ?></div>
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="description" value="<?= $description ?? '' ?>" autocomplete="description" required>
                </div>

                <div>
                    <button class="btn btn-dark mt-5" type="submit">Enregistrer</button>
                </div>

            </div>

        </form>
    </div>
</main>
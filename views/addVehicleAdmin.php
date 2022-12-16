<main class=" addVehicleAdmin container ">

    <h1>Ajouter un vehicule</h1>

    <div class="addVehicle">
        <form method="POST" id="form" enctype="multipart/form-data">

            <?php if (SessionFlash::exist()) { ?>
                <?= SessionFlash::get(); ?>
            <?php } ?>

            <div class="row justify-content-center mt-5">

                <!--NOM-->
                <div class="col-md-5 mt-3">
                    <div class="errorName"><?= $error['name'] ?? '' ?></div>
                    <label for="name" class="form-label">Nom du véhicule</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="NOM DU VEHICULE" value="<?= $name ?? '' ?>" autocomplete="name" required>
                </div>

                <div class="row justify-content-center">
                <!--PRIX DU VAN-->
                <div class="col-md-5 mt-3">
                    <div class="error"><?= $error['price'] ?? '' ?></div>
                    <label for="price" class="form-label">Prix</label>
                    <input class="form-control" id="price" name="price" placeholder="Prix" value="<?= $price ?? '' ?>" pattern="<?= REGEX_PRICE ?>" autocomplete="Description" required>
                </div>

                <div class="row justify-content-center">
                <!--DESCRIPTION-->
                <div class="col-md-5 mt-3">
                    <div class="errorDescription"><?= $error['description']  ?? '' ?></div>
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?= $description ?? '' ?>" autocomplete="Description" required>
                </div>


                <div class="row justify-content-center">
                <!--FICHIER-->
                <div class="col-md-5 mt-3">
                    <div class="errorDescription"><?= $error['profile']  ?? '' ?></div>
                    <label for="profile" class="form-label">Image de profile</label>
                    <input type="file" class="form-control" id="profile" name="profile" placeholder="Profile" autocomplete="profile" required>
                </div>

                <div>
                    <button class="btn btn-dark mt-5" type="submit">Enregistrer</button>
                </div>

            </div>

        </form>
    </div>
</main>
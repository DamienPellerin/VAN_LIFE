<main class="create container">

    <h1>Ajouter une agence</h1>

    <div class="addAgencie">

        <form method="POST" id="form" enctype="multipart/form-data">

            <?php if (SessionFlash::exist()) { ?>
                <?= SessionFlash::get(); ?>
            <?php } ?>

            <div class="row justify-content-center mt-5">

                <!--NOM DE L'AGENCE-->
                <div class="col-md-5 mt-3">
                    <div class="errorName"><?= $error['name'] ?? '' ?></div>
                    <label for="name" class="form-label">Nom de l'agence</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom de l'agence" value="<?= $name ?? '' ?>" pattern="<?= REGEX_NO_NUMBER ?>" autocomplete="name" required>
                </div>

                <div class="row justify-content-center">
                    <!--ADRESSE-->
                    <div class="col-md-5 mt-3">
                        <div class="error"><?= $error['adress'] ?? '' ?></div>
                        <label for="adress" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adress" name="adress" placeholder="">
                    </div>

                    <div class="row justify-content-center">

                        <!--CODE POSTAL-->
                        <div class="col-md-5">
                            <div class="error"><?= $error['zipcode'] ?? '' ?></div>
                            <label for="zipcode" class="form-label">Code Postal</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Code postal" required>
                        </div>

                        <!--VILLE-->
                        <div class="col-md-5">
                            <div class="error"><?= $error['city'] ?? '' ?></div>
                            <label for="city" class="form-label">Ville</label>
                            <select type="text" class="form-select" id="city" name="city" placeholder="Ville" required></select>
                        </div>

                    </div>

                    <div class="row justify-content-center">
                        <!--DESCRIPTION-->
                        <div class="col-md-5 mt-3">
                            <div class="errorDescription"><?= $error['description']  ?? '' ?></div>
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?= $description ?? '' ?>" autocomplete="description" required>
                        </div>

                        <div class="row justify-content-center">
                            <!--FICHIER-->
                            <div class="col-md-5 mt-3">
                                <div class="errorDescription"><?= $error['profile']  ?? '' ?></div>
                                <label for="profile" class="form-label">Image de profile</label>
                                <input type="file" class="form-control" id="profile" name="profile" placeholder="description" autocomplete="description" required>
                            </div>

                            <div class="col-12  mt-5 mb-3">
                                <button type="submit" class="btn btn-dark">Ajouter</button>
                            </div>
                        </div>
        </form>
    </div>
</main>
<script src="/../../../public/assets/js/app.js"></script>
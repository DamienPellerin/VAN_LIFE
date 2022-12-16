<main class=" container h-100 mt-5">

    <h1>Modification d'une agence</h1>

    <div class="modifyAgencie">
        <form method="POST" id="form">

            <?php if (SessionFlash::exist()) { ?>
                <?= SessionFlash::get(); ?>
            <?php } ?>

            <div class="row justify-content-center mt-5">

                <!--NOM DE L'AGENCE-->
                <div class="col-md-5 mb-3">
                    <div class="errorName"><?= $error['name'] ?? '' ?></div>
                    <label for="name" class="form-label">Nom de l'agence</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom de l'agence" value="<?= $agencie->name ?? '' ?>" pattern="<?= REGEX_NO_NUMBER ?>" autocomplete="name" required>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <!--ADRESSE-->
                <div class="col-md-5">
                    <div class="error"><?= $error['adress'] ?? '' ?></div>
                    <label for="adress" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adress" name="adress" placeholder="1234 Main St" value="<?= $agencie->adress ?? "" ?>">
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <!--DESCRIPTION-->
                <div class="col-md-5 ">
                    <div class="errorDescription"><?= $error['description']  ?? '' ?></div>
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="description" value="<?= $agencie->description ?? '' ?>" autocomplete="description" required>
                </div>
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

            <div class="row justify-content-center mb-3">
                <!--FICHIER-->
                <div class="col-md-5 ">
                    <div class="errorDescription"><?= $error['profile']  ?? '' ?></div>
                    <label for="profile" class="form-label">Image de profile</label>
                    <input type="file" class="form-control" id="profile" name="profile" placeholder="description" autocomplete="description" >
                </div>

                <div class="col-12 justify-content-center mt-5 mb-3">
                    <button type="submit" class="btn btn-dark">Modifier</button>
                </div>

            </div>

        </form>
    </div>

</main>
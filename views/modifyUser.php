<main class=" container">

    <h1 class="mt-5 mb-5">Modification de votre compte</h1>

    <div class="modifyUser row justify-content-center">
        
        <form method="POST" id="form" class="container mb-5">

            <?php if (SessionFlash::exist()) { ?>
                <?= SessionFlash::get(); ?>
            <?php } ?>

            <div class=" row justify-content-center mt-5">

                <!--NOM-->
                <div class="col-md-5">
                    <div class="errorName"><?= $error['lastname'] ?? '' ?></div>
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="NOM" value="<?= $userLastname ?? '' ?>" pattern="<?= REGEX_NO_NUMBER ?>" autocomplete="lastname" required>
                </div>

                <!--PRÉNOM-->
                <div class="col-md-5">
                    <div class="errorFirstName"><?= $error['firstname']  ?? '' ?></div>
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="PRÉNOM" value="<?= $userFirstname ?? '' ?>" pattern="<?= REGEX_NO_NUMBER ?>" autocomplete="firstname" required>
                </div>

            </div>

            <div class="row justify-content-center">

                <!--CODE POSTAL-->
                <div class="col-md-5">
                    <div class="error"><?= $error['zipcode'] ?? '' ?></div>
                    <label for="zipcode" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Code postal" value="<?= $userZipcode ?? '' ?>" required>
                </div>

                <!--VILLE-->
                <div class="col-md-5">
                    <div class="error"><?= $error['city'] ?? '' ?></div>
                    <label for="city" class="form-label">Ville</label>
                    <select type="text" class="form-select" id="city" name="city" placeholder="Ville" value="<?= $userCity ?? '' ?>" required></select>
                </div>

            </div>

            <div class="row justify-content-center">

                <!--DATE DE NAISSANCE-->
                <div class="col-md-5">
                    <div class="error"><?= $error['birthdate'] ?? '' ?></div>
                    <label for="birthdate" class="form-label">Date de naissance</label>
                    <input class="form-control" type="date" id="birthdate" name="birthdate" value="<?= $userBirthdate ?? '' ?>" min="01-01-1920" max="31-12-2022" placeholder="Date de naissance" required>
                </div>

                <!--E-MAIL-->
                <div class="col-md-5">
                    <div class="error"><?= $error['mail'] ?? '' ?></div>
                    <label for="mail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" value="<?= $userMail ?? '' ?>">
                </div>

            </div>

            <div class="row justify-content-center">

                <!--adresse-->
                <div class="col-md-5">
                    <div class="error"><?= $error['adress'] ?? '' ?></div>
                    <label for="adress" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adress" name="adress" placeholder="1234 Main St" value="<?= $userAdress ?? '' ?>">
                </div>

                <!--PHONE-->
                <div class="col-md-5">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" maxlength="10" Pattern="<?= REGEX_PHONE ?>" placeholder="numéro de téléphone" value="<?= $userPhone ?? '' ?>" required />
                </div>

            </div>

            <div class="col-12 justify-content-center mt-5 mb-5">
                <button type="submit" class="btn btn-dark">Modifier</button>
            </div>

        </form>
    </div>
</main>

<script src="../public/assets/js/app.js"></script>
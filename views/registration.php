<main>
    <div class="container-form">
        <div class="registration">
            <h1>FORMULAIRE D'INSCRIPTION</h1>
            <form method="POST" id="form" class="container">
                <?php if (SessionFlash::exist()) { ?>
                    <?= SessionFlash::get(); ?>
                <?php } ?>

                <!--NOM ET PRÉNOM-->
                <div class="row justify-content-center">
                    <!--NOM-->
                    <div class="col-md-5 mt-5 mb-2">
                        <div class="errorName"><?= $error['lastname'] ?? '' ?></div>
                        <label for="lastname" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="NOM" value="<?= $lastname ?? '' ?>" pattern="<?= REGEX_NO_NUMBER ?>" autocomplete="lastname" required>
                    </div>
                    <!--PRÉNOM-->
                    <div class="col-md-5 mt-5 mb-2">

                        <div class="errorFirstName"><?= $error['firstname']  ?? '' ?></div>
                        <label for="firstname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="PRÉNOM" value="<?= $firstname ?? '' ?>" pattern="<?= REGEX_NO_NUMBER ?>" autocomplete="firstname" required>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <!--CODE POSTAL-->
                    <div class="col-md-5 mt-3 mb-2">
                        <div class="error"><?= $error['zipcode'] ?? '' ?></div>
                        <label for="zipcode" class="form-label">Code Postal</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Code postal" required>
                    </div>
                    <!--VILLE-->
                    <div class="col-md-5 mt-3 mb-2">
                        <div class="error"><?= $error['city'] ?? '' ?></div>
                        <label for="city" class="form-label">Ville</label>
                        <select type="text" class="form-select" id="city" name="city" placeholder="Ville" required></select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <!--DATE DE NAISSANCE-->
                    <div class="col-md-5 mt-3 mb-2">
                        <div class="error"><?= $error['birthdate'] ?? '' ?></div>
                        <label for="birthdate" class="form-label">Date de naissance</label>
                        <input class="form-control" type="date" id="birthdate" name="birthdate" value="<?= $birthday ?? '' ?>" min="01-01-1920" max="31-12-2022" placeholder="Date de naissance" required>
                    </div>
                    <!--E-MAIL-->
                    <div class="col-md-5 mt-3 mb-2">
                        <div class="error"><?= $error['mail'] ?? '' ?></div>
                        <label for="mail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <!--adresse-->
                    <div class="col-md-5 mt-3 mb-2">
                        <div class="error"><?= $error['adress'] ?? '' ?></div>
                        <label for="adress" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adress" name="adress" placeholder="1234 Main St">
                    </div>
                    <!--PHONE-->
                    <div class="col-md-5 mt-3 mb-2">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" maxlength="10" Pattern="<?= REGEX_PHONE ?>" placeholder="numéro de téléphone" required />
                    </div>
                </div>

                <div class="row justify-content-center">
                    <!--PASSWORD-->
                    <div class="col-md-5 mt-3 mb-2">
                        <div class="error"><?= $error['password'] ?? '' ?></div>
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" pattern="<?= REGEX_PASSWORD ?>" required>
                    </div>
                    <!--CONFIRMATION PASSWORD-->
                    <div class="col-md-5 mt-3 mb-2">
                        <div class="error"><?= $error['password'] ?? '' ?></div>
                        <label for="confirm-password" class="form-label">Confirmation mot de passe</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" pattern="<?= REGEX_PASSWORD ?>" required>
                    </div>
                </div>

                <div class="check-box form-check justify-content-center mt-3">
                    <a href="../controllers/pcCtrl.php">politique de confidentialité</a>
                </div>

                <div class="col-12 justify-content-center mt-3">
                    <button type="submit" class="btn btn-dark mb-5">Inscription</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="../public/assets/js/app.js"></script>
<main class="connect">

    <div class="container-connexion ">


        <div class="connexion">
<h1>Connexion</h1>
            <?php if (SessionFlash::exist()) { ?>
                <?= SessionFlash::get(); ?>
            <?php } ?>

            <form action="" method="POST" class="form container mt-5 me-auto">

                <div class="row justify-content-center">
                    <div class="col-md-4 mb-5">

                        <div class="error"><?= $error['mail'] ?? '' ?></div>
                        <label for="mail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-4 mb-5">
                        <div class="error"><?= $error['password'] ?? '' ?></div>
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" pattern="<?= REGEX_PASSWORD ?>" required>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class=" ">
                        <button type="submit" class="btn btn-dark mb-3">Connexion</button>
                        <div class="link">
                            <a href="http://van_life.localhost/controllers/registrationController.php">Pas encore inscrit ?</a>
                            <a href="http://van_life.localhost/controllers/resetPasswordController.php">Mot de passe oublié?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
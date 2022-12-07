<main>
    <section>
        <div class="agencie-info">
            <div class="info"> </div>
        </div>
    </section>

    <section class="city">
        <?php foreach ($agencies as $agencie) { ?>
            <?php if ($agencie->id_agencies  == $agencieId) { ?>

                <h1>Louer un van aménagé à <?= $agencie->name ?></h1>
                <p><?= $agencie->description ?></p>
            <?php } ?>

        <?php } ?>

        <div class="all-modeles">
            <button><a href="../controllers/agenciesController.php">Dés 65€ / nuit</a></button>
        </div>

    </section>
    <section>
        <h2>Tu peux récupérer ton véhicule ici</h2>
    </section>
</main>
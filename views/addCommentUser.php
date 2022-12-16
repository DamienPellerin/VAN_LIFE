<main>
    <div class="message mb-3 fs-5">
        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>
    </div>
    <section class="row justify-content-center">
        <div class="comment-user ">
            <form method="POST" class="">
                <div class="mb-3">
                    <h2>Laissez un commentaire</h2>
                    <label for="user-comment" class="form-label-comment"></label>
                    <textarea class="form-control" id="comment" name="comment" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Envoyer</button>
            </form>
        </div>
    </section>
</main>
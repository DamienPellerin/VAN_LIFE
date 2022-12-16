<main>
  <div class="message mb-3 fs-5">
    <?php if (SessionFlash::exist()) { ?>
      <?= SessionFlash::get(); ?>
    <?php } ?>
  </div>
  <h2 class="mt-5 mb-5">Liste des commentaires</h2>
  <?php if (isset($_SESSION['user']) && ($_SESSION['user']->role == 1)) { ?>
    <section class="comment ">
      <?php foreach ($comments_user as $comment) { ?>
        <div class=" comment-card  card">

          <div class="card-body">

            <h5 class="card-title"><?= $comment->firstname ?> <?= $comment->lastname ?> </h5>
            <p><?= ucfirst($formatDateFr->format(strtotime($comment->created_at))) ?? '' ?></p>
            <p class="card-text"><?= $comment->comment ?></p>

            <a class="text-decoration-none text-dark" href="/controllers/admin/delete/deleteCommentCtrl.php?id=<?= $comment->id_comments  ?>"><img src="/public/assets/img/x-circle.svg" alt=""></a>
          </div>

        </div>
      <?php } ?>
    </section>
  <?php } else if (isset($_SESSION['user']) && ($_SESSION['user']->role == 3)) { ?>
    <section class="comment ">

     <?php foreach ($comments_user as $comment) { ?>
      <div class=" comment-card  card">

        <div class="card-body">

          <h5 class="card-title"><?= $comment->firstname ?> <?= $comment->lastname ?> </h5>
          <p><?= ucfirst($formatDateFr->format(strtotime($comment->created_at))) ?? '' ?></p>
          <p class="card-text"><?= $comment->comment ?></p>

        </div>

      </div>
    <?php } ?>
    </section>
  <?php } else { ?>
    <section class="comment ">

<?php foreach ($comments_user as $comment) { ?>
<div class=" comment-card  card">

  <div class="card-body">

    <h5 class="card-title"><?= $comment->firstname ?> <?= $comment->lastname ?> </h5>
    <p><?= ucfirst($formatDateFr->format(strtotime($comment->created_at))) ?? '' ?></p>
    <p class="card-text"><?= $comment->comment ?></p>

  </div>

</div>
<?php }  ?>
</section>
<?php }  ?>
</main>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VAN LIFE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="/../../public/assets/css/style.css">
  <!--<link rel="stylesheet" href="/../../public/assets/css/bootstrap.min.css">-->
  <!-- Swiper CSS -->
  <!--<link rel="stylesheet" href="css/swiper-bundle.min.css">-->
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body>
  <header>
  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
          <a class="title navbar-brand" href="/controllers/homeController.php">VAN LIFE</a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarColor01">
          <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link active" href="/controllers/homeController.php">Accueil
                <span class="visually-hidden">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/controllers/agenciesController.php">Agences</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/controllers/vehiclesController.php">Vehicules</a>
            </li>
        </ul>
       </div>
      <div class="nav-authentication">
        <div class="sign-btns ">  
          <?php if (isset($_SESSION['user']) && ($_SESSION['user']->role == 3)) { ?>
            <div class="btn-group " role="group" aria-label="Button group with nested dropdown">
              <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['user']->firstname ?>     </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="../../controllers/user/userDashboardCtrl.php">Compte</a>
                <a class="dropdown-item" href="../../controllers/signOutCtrl.php">Deconnexion</a>
              </div>
            </div>

          <?php } elseif (isset($_SESSION['user']) && ($_SESSION['user']->role == 1)) { ?>
            <div class="dropdown-center">
              <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrateur</button>
              <div class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item " href="/../controllers/admin/adminCtrl.php">Compte</a>
                <a class="dropdown-item" href="../../controllers/signOutCtrl.php">Deconnexion  </a>
              </div>
            </div>

          <?php } else { ?>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compte</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="../controllers/connectionController.php">Connexion</a>
              </div>
            </div>
          <?php } ?>
        </div>

      </div>
      </div>
    </nav>
  </header>
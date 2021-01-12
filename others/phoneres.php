<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MadinaTech - Paramètres</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div><div class="sidebar-brand-text mx-3"> Admin </div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item"><a class="nav-link" href="resp.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Page d'accueil</span></a></li>
      <li class="nav-item"><a class="nav-link" href="gestionreport.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Nouveaux signalements</span></a></li>
      <li class="nav-item"><a class="nav-link" href="gestionannonce.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Nouveaux annonces</span></a></li>
      <li class="nav-item"><a class="nav-link" href="statsresp.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Statiques</span></a></li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Carte </span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="mapnew.php">Nouveaux</a>
            <a class="collapse-item" href="mapexist.php">Exsiter</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Téléphone</span>
        </a>
        <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="dropdown-item" href="passres.php">Modifier mot de passe</a>
            <a class="collapse-item" href="phoneres.php">Modifier téléphone</a>
            <a class="collapse-item" href="emailres.php">Modifier email</a>
            <a class="collapse-item" href="addressres.php">Modifier adrress</a>
            <div class="dropdown-divider"></div>
            <a class="collapse-item" href="log.php">Se déconnecter</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          </nav>
          <div class="container">
            <h2>Changer le numéro de téléphone</h2>
          	<form action="manage.php" method="POST">
              <div class="form-group">
                <label>Telephone:</label>
                <input class="form-control" type="tel" name="new" placeholder="Nouveau numéro" pattern="[0-9]{10}" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="phone">Changer</button>
              </div>
          	</form>
          </div><!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>

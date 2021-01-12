<?php
$inactive = 1200;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();
if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MadinaTech - Profile</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient( #008BFF,#219AFF,#4FAFFF, #6EBDFF);">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas"></i></div><div class="sidebar-brand-text mx-3"><?php $user = $_SESSION['username'];echo "$user";?></div></a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item "><a class="nav-link" href="auth.php"><i class="fas fa-home"></i><span>&#160;Page d'accueil</span></a></li>
      <li class="nav-item"><a class="nav-link" href="announce.php"><i class="fas fa-file-signature"></i><span>&#160;Ecrire une annonce</span></a></li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="viewann.php" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-bullhorn"></i>
          <span>&#160;Voir annonce</span></a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item  fas fa-bullhorn" href="viewann.php">&#160;Nouvelle</a>
            <a class="collapse-item  fas fa-bullhorn" href="annrej.php">&#160;Réfusées</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-paste"></i>
          <span>Voir signalement</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item fas fa-paste" href="declared.php">&#160;Nouveaux signalements</a>
            <a class="collapse-item fas fa-paste" href="encours.php">&#160;Signalements en cours</a>
            <a class="collapse-item fas fa-paste" href="finished.php">&#160;Signalement cloturés</a>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="statauth.php"><i class="fas fa-fw fa-chart-area"></i><span>Statiques</span></a></li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Modifier profile</span></a>
          <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item fas fa-cogs " href="passau.php"> &#160; Modifier mot de passe</a>
              <a class="collapse-item fas fa-user" href="manageaccount.php"> &#160; Modifier compte</a>
              <div class="dropdown-divider"></div>
              <a class="collapse-item fas fa-sign-out-alt" href="http://127.0.0.1/site/log.php"> &#160; Se déconnecter</a>
            </div>
          </div>
      </li>
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
        <div class="container-fluid">
          <div class="row">
          <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php
        $db_username = 'root';
        $db_password = '';
        $db_name     = 'base';
        $db_host     = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
               or die('could not connect to database');
        if($_SESSION['username'] !== ""){
          $user = $_SESSION['username'];
          $result = mysqli_query($db,"SELECT * FROM user where username = '".$user."'");
          while($row = mysqli_fetch_array($result)){
            echo'
          <div class=\container" style="margin-left:20%;margin-top:5%">
            <h2>Modifier compte</h2>
          	<form action="manage.php" method="POST">
              <div class="form-group col-md-6">
                <label>Address:</label>
                <input class="form-control" type="text" name="address" value= "'.$row['adress'].'" placeholder="Nouveau address" required>
              </div>
              <div class="form-group col-md-6">
                <label>Email:</label>
                <input class="form-control" type="email" name="email" value= "'.$row['email'].'" placeholder="Nouveau email" required>
              </div>
              <div class="form-group col-md-6">
                <label>Telephone:</label>
                <input class="form-control" type="tel" name="phone" value= "'.$row['phone'].'" placeholder="Nouveau numéro" pattern="[0-9]{10}" required>
              </div>
              <div class="form-group" style="margin-left:20%;margin-top:5%">
                <button type="submit" class="btn btn-primary" name="manage">Changer</button>
              </div>
          	</form>';

                      }
                    }
                    ?>
          </div>
        </div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>
</html>

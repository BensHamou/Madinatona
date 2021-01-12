<?php
$inactive = 1200;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();
if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
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
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient( #008BFF,#219AFF,#4FAFFF, #6EBDFF);">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas"></i></div><div class="sidebar-brand-text mx-3"><?php $user = $_SESSION['username'];echo "$user";?></div></a>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item"><a class="nav-link" href="admin.php"><i class="fas fa-home"></i><span>Page d'accueil</span></a></li>
      <li class="nav-item"><a class="nav-link" href="demandedajout.php"><i class="fas fa-vote-yea"></i><span>&#160;Demandes d'inscription</span></a></li>
      <li class="nav-item "><a class="nav-link" href="createuser.php"><i class="fas fa-user-plus"></i><span>&#160;Créer un utilisateur</span></a></li>
      <li class="nav-item"><a class="nav-link" href="type.php"><i class="fas fa-user-tie"></i><span>&#160;Gestion Catégories</span></a></li>
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
           <i class="fas fa-address-card"></i>
          <span>&#160;List</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item  fas fa-address-card" href="signaledusers.php">&#160;Signalés</a>
            <a class="collapse-item fas fa-address-card" href="activate.php">&#160;Désactivés</a>
          </div>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="déactiver.php"><i class="fas fa-user-minus"></i><span>&#160;Désactiver un profile</span></a></li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Mot de passe</span>
        </a>
        <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item fas fa-cogs" href="passadd.php"> &#160; Modifier mot de passe</a>
            <a class="collapse-item fas fa-user" href="manageaccountadd.php"> &#160; Modifier compte</a>
            <div class="dropdown-divider"></div>
            <a class="collapse-item fas fa-sign-out-alt" href="http://127.0.0.1/site/log.php"> &#160; Se déconnecter</a>
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
            <h2>Changer le mot de pass</h2>
          	<form action="manage.php" method="POST" onsubmit="return checkForm();">
          		<div class="form-group">
          			<label>Mot de pass courant:</label>
          			<input type="password" id="password" name="cp" placeholder="Mot de pass courant" class="form-control" data-toggle="password" required>
          		</div>
              <div class="form-group">
                <label>Nouveau mot de pass:</label>
                <input type="password" id="passwordnew" name="np" placeholder="Nouveau mot de pass" class="form-control" data-toggle="password" required>
              </div>
              <div class="form-group">
                <label>Confirmer nouveau mot de pass:</label>
                <input type="password" id="passwordnewconf" placeholder="Confirmer nouveau mot de pass" name="cnp" class="form-control" data-toggle="password" required>
              </div>
          		<div class="form-group">
          			<button type="submit" class="btn btn-primary" name="pass">Changer</button>
          		</div>
          	</form>
          </div>
          <script type="text/javascript">
          function checkForm(){
            var np = document.getElementById("passwordnew");
            var cnp = document.getElementById("passwordnewconf");
            if(np.value != cnp.value){
            alert("Please confirm password again.");
            return false;
          }
          return true;
        }
          $("#password").password('toggle');
          $("#passwordnew").password('toggle');
          $("#passwordnewconf").password('toggle');
          </script>
<!-- Bootstrap core JavaScript-->
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

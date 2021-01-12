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

  <title>MadinaTech - Créer Utilisateur</title>

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
      <li class="nav-item active"><a class="nav-link" href="createuser.php"><i class="fas fa-user-plus"></i><span>&#160;Créer un utilisateur</span></a></li>
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
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Mon compte</span>
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
        <div class="container-fluid" >
          <div class="row" style="padding:5%;background-repeat: no-repeat; background-image: url('img/bg_gradinat.png');">
            <form style="margin-left:35%" action="createuser.php" method="POST">
              <h2 style="color:black"> Créer un profile</h2>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label style="color:black">Nom</label>
                  <input type="text" style="color:black" class="form-control" name="nom" placeholder="Nom" required>
                </div>
                <div class="form-group col-md-6">
                  <label style="color:black">Prenom</label>
                  <input type="text" style="color:black" class="form-control" name="prenom" placeholder="Prenom" required>
                </div>
              </div>
              <div class="form-group">
                <label style="color:black">Date de naissance</label>
                <input placeholder="Date de naissance" type="text" onfocus="(this.type='date')" style="color:black" class="form-control" max= <?php $d=mktime(11, 14, 54, 1, 1, 2001); echo date("Y-m-d h:i:sa", $d);?> name="daten" required>
              </div>
              <div class="form-group">
                <label style="color:black">Address</label>
                <input type="text" style="color:black" class="form-control" name="adress" placeholder="12 Rue .." required>
              </div>
              <div class="form-group">
                <label style="color:black">Numéro de téléphone</label>
                <input class="form-control" style="color:black" type="tel" name="phone" placeholder="Numero de téléphone" pattern="[0-9]{10}" required>
              </div>
              <div class="form-group">
                <label style="color:black">Email</label>
                <input type="email" style="color:black" class="form-control" name="email" placeholder="Email" required>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label style="color:black">Nom d'utilisateur</label>
                  <input type="text" style="color:black" class="form-control" name="newuser" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="form-group col-md-6">
                  <label style="color:black">Mot de pass</label>
                  <input type="password" style="color:black" id="password" name="password" class="form-control" placeholder="Mot de pass" data-toggle="password" required>
                </div>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label style="color:black">Role</label>
                  <select class="form-control" name="type" style="color:black">
                    <optgroup label="Gestionnaire">
                    <option value="-2" style="color:black">Résponsable</option>';
                    <option value="-1" style="color:black">Admin</option>';
                    </optgroup>
                    <optgroup label="Autorité">
                    <?php
                    $db_username = 'root';
                    $db_password = '';
                    $db_name     = 'base';
                    $db_host     = 'localhost';
                    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                    or die('could not connect to database');
                    $result = mysqli_query($db,"SELECT * FROM type");
                    while ($row = mysqli_fetch_array($result)){
                        echo '<option style="color:black" value="'.$row['idtype'].'">'.$row['nametype'].'</option>';
                      }
                      ?>
                    </optgroup>
                  </select>
                </div>
              </div>
              <button type="submit" name='ajouter' class="btn btn-primary">Créer</button>
            </form>
            <?php
             if(isset($_POST['ajouter'])){
               $nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom']));
               $prenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['prenom']));
               $daten = mysqli_real_escape_string($db,htmlspecialchars($_POST['daten']));
               $adress = mysqli_real_escape_string($db,htmlspecialchars($_POST['adress']));
               $phone = mysqli_real_escape_string($db,htmlspecialchars($_POST['phone']));
               $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email']));
               $nusername = mysqli_real_escape_string($db,htmlspecialchars($_POST['newuser']));
               $password = sha1(mysqli_real_escape_string($db,htmlspecialchars($_POST['password'])));
               $type = mysqli_real_escape_string($db,htmlspecialchars($_POST['type']));
               $requete = "INSERT into user(nom, prenom, dateN, adress, phone, email, username, password, type, visible, signaled) values
               ('".$nom."','".$prenom."','".$daten."','".$adress."', '".$phone."',  '".$email."','".$nusername."','".$password."','".$type."',1,0)";
               $exec_requete = mysqli_query($db,$requete);
               if($exec_requete){
                 $message = "Profile creer";
                 echo "<script type='text/javascript'>alert('$message');</script>";
                 print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");
               }
               else{
                 $message = "Error.. please try again";
                 echo "<script type='text/javascript'>alert('$message');</script>";
                 print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");
               }
               }
            ?>
          </div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>

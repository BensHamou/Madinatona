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
  <link rel="stylesheet" href="popup.css" media="screen" type="text/css" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>MadinaTech - Gestion Catégorie</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
      <li class="nav-item active"><a class="nav-link" href="type.php"><i class="fas fa-user-tie"></i><span>&#160;Gestion Catégories</span></a></li>
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
        <div class="container-fluid">
          <div class="row">
            <?php
            $db_username = 'root';
            $db_password = '';
            $db_name     = 'base';
            $db_host     = 'localhost';
            $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
            or die('could not connect to database');
            $result = mysqli_query($db,"SELECT * FROM type");
            while($row = mysqli_fetch_array($result)){
              echo '<div class="col-md-auto col-xs-auto">';
              echo '<div  class="card border-primary mb-3" style="max-width: 18rem;">';
              echo '<div class="card-body">';
              echo  '<p class="adress"><ins>Nom d\'athorité</ins>: <br>' . $row['nametype'] . '</p>';
              $type = $row['idtype'];
              $result2 = mysqli_query($db,"SELECT count(*) FROM user where type =  '".$type."'");
                while($row2 = mysqli_fetch_array($result2)){
              echo  '<p class="adress">Il ya : ' . $row2['count(*)'] . ' comptes associés a cet athorité</p>';
            }
            if(isset($_POST['edit'])){
              $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
              echo '<form action="type.php" method="post">';
              if($type==$id){
                echo '<input type="text"  class="form-control" placeholder="Nouveau nom" name="newname">';
                echo '<input type="hidden"  value="' . $row['idtype']  . '" name="hid">
                <input class="btn btn-primary" style="margin-top:3%" type="submit" value="Modifier le nom" name="editde">
                <a href="type.php" class="btn btn-danger active" style="margin-top:3%" role="button" aria-pressed="true">Cancel</a>
                </form>';
              }
              }
              else{
                echo '<form action="type.php" method="post">
                <input type="hidden"  value="' . $row['idtype']  . '" name="hid">
                <input class="btn btn-secondary" type="submit" value="Modifier le nom" name="edit">
                </form>';
              }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            }
            if(isset($_POST['editde'])){
              $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
              $nom=mysqli_real_escape_string($db,htmlspecialchars($_POST['newname']));
              $requete = "UPDATE type set nametype= '".$nom."' where idtype = '".$id."'  ";
              $exec_requete = mysqli_query($db,$requete);
              print("<script type=\"text/javascript\">location.href=\"type.php\"</script>");
            }
            if(isset($_POST['add'])){
              $nom=mysqli_real_escape_string($db,htmlspecialchars($_POST['name']));
              $requete = "INSERT INTO type (nametype) values('".$nom."')";
              $exec_requete = mysqli_query($db,$requete);
              print("<script type=\"text/javascript\">location.href=\"type.php\"</script>");
            }
   ?>
   <?php
   if(!isset($_POST['edit'])){
     echo '
     <button class="open-button" onclick="openForm()">Ajouter une nouvelle catégorie</button>
     <div class="chat-popup" id="myForm">
       <form  action="type.php" method="POST" class="form-container">
         <h1>Nouvelle Catégorie</h1>
         <input type="text" class="form-control" style="height:50px;color:black;" placeholder="Nom de catégorie" name="name" required >
         <input class="btn btn-primary" style="margin-top:3%" type="submit" value="Ajouter" name="add">
         <button type="button" class="btn btn-danger" style="background-color:red" onclick="closeForm()">Annuler</button>
       </form>
     </div>';
   }
     ?>
     <script>
     function openForm() {
       document.getElementById("myForm").style.display = "block";
     }

     function closeForm() {
       document.getElementById("myForm").style.display = "none";
     }
     </script>
   </div>
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>


</body>
</html>

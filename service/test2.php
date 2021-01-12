<?php
session_start();
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

  <title>MadinaTech - Désactivés</title>

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
      <li class="nav-item"><a class="nav-link" href="admin.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Page d'accueil</span></a></li>
      <li class="nav-item"><a class="nav-link" href="demandedajout.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Demandes d'inscription</span></a></li>
      <li class="nav-item"><a class="nav-link" href="createuser.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Créer un utilisateur</span></a></li>
      <li class="nav-item"><a class="nav-link" href="type.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Gestion Catégories</span></a></li>
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>List Désactivés</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="signaledusers.php">Signalés</a>
            <a class="collapse-item" href="activate.php">Désactivés</a>
          </div>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="déactiver.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Désactiver un profile</span></a></li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Mon compte</span>
        </a>
        <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="dropdown-item" href="passadd.php">Modifier mot de passe</a>
            <a class="collapse-item" href="phoneadd.php">Modifier téléphone</a>
            <a class="collapse-item" href="emailadd.php">Modifier email</a>
            <a class="collapse-item" href="addressadd.php">Modifier adrress</a>
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
          <form action="" method="post" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" id="search" name="username" placeholder="Nom d'utilisateur" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Rechercher</button>
          </form>
          <script>
           document.getElementById("search").value = "<?php echo $_POST['username'];?>";
          </script>
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
   if (!empty($_POST['username'])) {
     $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username']));
     $sql = "SELECT * FROM user WHERE username LIKE '%".$username."%' and visible=0";
     $r_query =  mysqli_query($db,$sql);
     while ($row = mysqli_fetch_array($r_query)){
       echo '<div class="col-md-auto col-xs-auto">';
       echo '<div  class="card border-primary mb-3" style="max-width: 18rem;">';
       echo '<div class="card-body">';
       echo  '<p class="adress"><ins>Nom et Prenom</ins>: <br>' . $row['nom']  .' '. $row['prenom'] . '</p>';
       echo  '<p class="username"><ins>Nom d\'utilisateur</ins>: <br>'. $row['username'] . '</p>';
       echo  '<p class="adress"><ins>Numero de téléphone</ins>: <br>' . $row['phone'] . '</p>';
       echo  '<p class="adress"><ins>Email</ins>:<br> ' . $row['email'] . '</p>';
       echo  '<p class="adress"><ins>Address</ins>: <br>' . $row['adress'] . '</p>';
       $type = $row['type'];
       if($type==-2){
         echo  '<p class="adress"><ins>Role</ins>: <br> Résponsable</p>';
       }
       else if($type==-1){
         echo  '<p class="adress"><ins>Role</ins>: <br> Admin</p>';
       }
       else if($type==0){
         echo  '<p class="adress"><ins>Role</ins>: <br> Citoyen</p>';
       }
       else if($type>0){
         $result2 = mysqli_query($db,"SELECT * FROM type WHERE idtype='".$type."'");
         while($row2 = mysqli_fetch_array($result2)){
           echo  '<p class="adress"><ins>Authorité de</ins>: <br> ' . $row2['nametype']  .'</p>';
         }
       }
       echo '<form action="activate.php" method="post">
       <input type="hidden"  value="' . $row['id']  . '" name="hid">
       <input type="hidden"  value="' . $row['email']  . '" name="mail">
       <input  class="btn btn-success" type="submit" value="Réactiver profile" name="activer">
       </form>';
       echo '</div>';
       echo '</div>';
       echo '</div>';
     }
   }
   else{
   $result = mysqli_query($db,"SELECT * FROM user WHERE visible=0");
   while($row = mysqli_fetch_array($result)){
     echo '<div class="col-md-auto col-xs-auto">';
     echo '<div  class="card border-primary mb-3" style="max-width: 18rem;">';
     echo '<div class="card-body">';
     echo  '<p class="adress"><ins>Nom et Prenom</ins>: <br>' . $row['nom']  .' '. $row['prenom'] . '</p>';
     echo  '<p class="username"><ins>Nom d\'utilisateur</ins>: <br>'. $row['username'] . '</p>';
     echo  '<p class="adress"><ins>Numero de téléphone</ins>: <br>' . $row['phone'] . '</p>';
     echo  '<p class="adress"><ins>Email</ins>:<br> ' . $row['email'] . '</p>';
     echo  '<p class="adress"><ins>Address</ins>: <br>' . $row['adress'] . '</p>';
     $type = $row['type'];
     if($type==-2){
       echo  '<p class="adress"><ins>Role</ins>: <br> Résponsable</p>';
     }
     else if($type==-1){
       echo  '<p class="adress"><ins>Role</ins>: <br> Admin</p>';
     }
     else if($type==0){
       echo  '<p class="adress"><ins>Role</ins>: <br> Citoyen</p>';
     }
     else if($type>0){
       $result2 = mysqli_query($db,"SELECT * FROM type WHERE idtype='".$type."'");
       while($row2 = mysqli_fetch_array($result2)){
         echo  '<p class="adress"><ins>Authorité de</ins>: <br> ' . $row2['nametype']  .'</p>';
       }
     }
     echo '<form action="activate.php" method="post">
     <input type="hidden"  value="' . $row['id']  . '" name="hid">
     <input type="hidden"  value="' . $row['email']  . '" name="mail">
     <input  class="btn btn-success" type="submit" value="Réactiver profile" name="activer">
     </form>';
     echo '</div>';
     echo '</div>';
     echo '</div>';
   }
   if(isset($_POST['activer'])){
     $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
     $requete = "UPDATE user set visible=1 where id = '".$id."'  ";
     $exec_requete = mysqli_query($db,$requete);
     print("<script type=\"text/javascript\">location.href=\"activate.php\"</script>");
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>

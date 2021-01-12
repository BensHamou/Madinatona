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

  <title>MadinaTech - Profiles</title>

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
      <li class="nav-item active"><a class="nav-link" href="déactiver.php"><i class="fas fa-user-minus"></i><span>&#160;Désactiver un profile</span></a></li>
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
     $sql = "SELECT * FROM user WHERE username LIKE '%".$username."%' and visible=1";
     $r_query =  mysqli_query($db,$sql);
     while($row = mysqli_fetch_array($r_query)){
       echo '<div class="col-md-auto col-xs-auto">';
       echo '<div  class="card border-primary mb-3" style="max-width: 18rem;">';
       echo '<div class="card-body">';
       echo  '<p class="adress"><ins>Nom et Prenom</ins>: <br>' . $row['nom']  .' '. $row['prenom'] . '</p>';
       echo  '<p class="adress"><ins>Né le</ins>: <br>' . $row['dateN']  .'</p>';
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
       echo '<form action="déactiver.php" method="post">
       <input type="hidden"  value="' . $row['id']  . '" name="hid">
       <input type="hidden"  value="' . $row['email']  . '" name="mail">
       <input  class="btn btn-danger" type="submit" value="Désactiver profile" name="désactiver">
       </form>';
       echo '</div>';
       echo '</div>';
       echo '</div>';
     }
   }
   else{
   $result = mysqli_query($db,"SELECT * FROM user WHERE visible=1");
   while($row = mysqli_fetch_array($result)){
     echo '<div class="col-md-auto col-xs-auto">';
     echo '<div  class="card border-primary mb-3" style="max-width: 18rem;">';
     echo '<div class="card-body">';
     echo  '<p class="adress"><ins>Nom et Prenom</ins>: <br>' . $row['nom']  .' '. $row['prenom'] . '</p>';
     echo  '<p class="adress"><ins>Né le</ins>: <br>' . $row['dateN']  .'</p>';
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
     echo '<form action="déactiver.php" method="post">
     <input type="hidden"  value="' . $row['id']  . '" name="hid">
     <input type="hidden"  value="' . $row['email']  . '" name="mail">
     <input  class="btn btn-danger" type="submit" value="Désactiver profile" name="désactiver">
     </form>';
     echo '</div>';
     echo '</div>';
     echo '</div>';
   }
   if(isset($_POST['désactiver'])){
     $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
     $mailto=mysqli_real_escape_string($db,htmlspecialchars($_POST['mail']));
     $requete = "UPDATE user set visible=0 where id = '".$id."'  ";
     $exec_requete = mysqli_query($db,$requete);
     require_once(dirname(__FILE__) . "/PHPMailer-5.2.28/class.smtp.php");
     require_once(dirname(__FILE__) . "/PHPMailer-5.2.28/class.phpmailer.php");
     $mail = new PHPMailer(true);
     $mail ->IsSmtp();
     $mail ->SMTPDebug = 0;
     $mail ->SMTPAuth = true;
     $mail ->SMTPSecure = 'ssl';
     $mail ->Host = "smtp.gmail.com";
     $mail ->Port = 465; // or 587
     $mail ->IsHTML(true);
     $mail ->Username = "amadinatec@gmail.com";
     $mail ->Password = "admin123T";
     $mail ->SetFrom("amadinatec@gmail.com");
     $mail ->Subject  = "NOTICE";
     $mail ->Body = "DÉSOLÉ VOTRE COMPTE A ÉTÉ DÉSACTIVÉ : pas du respect de notre politique.";
     $mail ->AddAddress($mailto);
     $mail->SMTPOptions = array('ssl' => array(
     'verify_peer' => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true
   ));
   $mail->Send();
     print("<script type=\"text/javascript\">location.href=\"déactiver.php\"</script>");
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>

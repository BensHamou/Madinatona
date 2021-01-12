<?php
$inactive = 1200;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();
if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time();
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

  <title>MadinaTech - Gestion signalement</title>

  <!-- Custom fonts for this template-->


</head>
<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient( #008BFF,#219AFF,#4FAFFF, #6EBDFF);">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas"></i></div><div class="sidebar-brand-text mx-3"><?php $user = $_SESSION['username'];echo "$user";?></div></a>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item"><a class="nav-link" href="resp.php"><i class="fas fa-home"></i><span>&#160;Page d'accueil</span></a></li>
      <li class="nav-item active"><a class="nav-link" href="gestionreport.php"><i class="fas fa-paste"></i><span>&#160;Gestion de signalements</span></a></li>
      <li class="nav-item"><a class="nav-link" href="gestionannonce.php"><i class="fas fa-bullhorn"></i><span>&#160;Gestion d'annonces</span></a></li>
      <li class="nav-item"><a class="nav-link" href="statsresp.php"><i class="fas fa-fw fa-chart-area"></i><span>&#160;Statistiques</span></a></li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-map-marked-alt"></i>
          <span>&#160;Explorez carte</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item fas fa-map-marked-alt" href="mapnew.php">&#160;Nouveaux signalements</a>
            <a class="collapse-item fas fa-map-marked-alt" href="mapexist.php">&#160;Signalements actifs</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Mon compte</span>
        </a>
        <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item fas fa-cogs" href="passres.php"> &#160; Modifier mot de passe</a>
            <a class="collapse-item fas fa-user" href="manageaccountres.php"> &#160; Modifier compte</a>
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
            $db = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');
            $result = mysqli_query($db,"SELECT * FROM signalement WHERE  etat = 1 and visible=1 ORDER BY date1 desc");
            while($row = mysqli_fetch_array($result)){
              echo '<div class="col-md-6" style="margin-bottom:0.5%;">';
              echo '<form action="gestionreport.php"  method="post"><div class="card border-info" style="margin-top:5%;">';
              echo '<div class="card-header"><h1 class="card-title" style="margin-left:25%;"><ins> Titre</ins>: '. $row['title'] . '</h1></div>';
              echo '<img class="rounded" src="'.$row['image'].'" alt  = "No photo for this report." style="margin-top:3%;margin-left:auto;margin-right:auto;width:50%;height:30%;" >';
              echo '<div class="card-body">';
              echo  '<p5 class="username" style="color:black"><ins>Signalé par</ins>: '. $row['username'] . '</p>';
              echo '<p5 class="card-text" style="color:black"><ins>Le</ins>: ' . $row['date1'] . '</p>';
              echo  '<p5 class="adress" style="color:black"><ins>À</ins>: ' . $row['adress'] . '</p>';
              echo "<div class=\"card-header\"><p5> <ins>Description</ins>: <br>" . $row['description'] . "</p5></div>";
              echo "<hr class=\"sidebar-divider my-0\">";
              echo '

              <div class="form-row" style="margin-top:10%">
                <div class="form-group col-md-6">
                  <label for="inputState">Catégorie</label>
                  <select class="form-control" name="type" style="color:black">';
                    $result2 = mysqli_query($db,"SELECT * FROM type");
                    while ($row2 = mysqli_fetch_array($result2)){
                      if($row2['idtype']==$row['type']){
                        echo '<option selected value="'.$row2['idtype'].'">'.$row2['nametype'].'</option>';
                      }
                      else{
                        echo '<option  value="'.$row2['idtype'].'">'.$row2['nametype'].'</option>';
                      }
                    }
                  echo '</select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">Priorité</label>
                  <select class="form-control" name="priority" style="color:black">';
                  echo '<option style="color:green" value="1">Normal</option>';
                  echo '<option style="color:orange" value="2">Elevé</option>';
                  echo '<option style="color:red" value="3">Trés elevé</option>';
                  echo '</select>
                </div>
              </div>
              ';
              echo '
              <input type="hidden"  value="' . $row['id']  . '" name="hid">
              <input type="hidden"  value="' . $row['username']  . '" name="usersign">
              <input class="btn btn-success" style="margin-left:22%;" type="submit" value="Valider" name="accepter">
              <input  class="btn btn-danger" type="submit" value="Rejeter" name="supprimer">
              <input  class="btn btn-warning" type="submit" onclick="return confirm(\'Voulez vous rejeter ce signale et signaler ' . $row['username']  . ' ?\')" value="Signaler" name="signaler">
              </form>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
            if(isset($_POST['accepter'])){
              $username=mysqli_real_escape_string($db,htmlspecialchars($_POST['usersign']));
              $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
              $type=mysqli_real_escape_string($db,htmlspecialchars($_POST['type']));
              $priority=mysqli_real_escape_string($db,htmlspecialchars($_POST['priority']));
              $requete = "UPDATE signalement SET visible=2,type=\"$type\",priority=\"$priority\" where id =\"$id\"";
              $exec_requete = mysqli_query($db,$requete);
              $mailto = mysqli_query($db,"SELECT * FROM user WHERE  username =\"$username\"");
              while($row = mysqli_fetch_array($mailto)){
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
                $mail ->Body = "Votre signalement a été approuvé.";
                $mail ->AddAddress($row["email"]);
                $mail->SMTPOptions = array('ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
                ));
                $mail->Send();
                print("<script type=\"text/javascript\">location.href=\"gestionreport.php\"</script>");
              }
            }
            if(isset($_POST['supprimer'])){
              $username=mysqli_real_escape_string($db,htmlspecialchars($_POST['usersign']));
              $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
              $requete = "UPDATE signalement SET visible=0  where id =\"$idi\"";
              $exec_requete = mysqli_query($db,$requete);
              $mailto = mysqli_query($db,"SELECT * FROM user WHERE  username =\"$username\"");
              while($row = mysqli_fetch_array($mailto)){
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
                $mail ->Body = "Votre signalement a été rejeté.";
                $mail ->AddAddress($row["email"]);
                $mail->SMTPOptions = array('ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
                ));
                $mail->Send();
                print("<script type=\"text/javascript\">location.href=\"gestionreport.php\"</script>");
              }
            }
            if(isset($_POST['signaler'])){
              $username=mysqli_real_escape_string($db,htmlspecialchars($_POST['usersign']));
              $idi=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
              $requete = "UPDATE user SET signaled=signaled+1  where username =\"$username\"";
              $requete2 = "UPDATE signalement SET visible=0  where id =\"$idi\"";
              $exec_requete = mysqli_query($db,$requete);
              $exec_requete2 = mysqli_query($db,$requete2);
              $mailto = mysqli_query($db,"SELECT * FROM user WHERE  username =\"$username\"");
              while($row = mysqli_fetch_array($mailto)){
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
                $mail ->Body = "Vous avez été signalé, veuillez faire attention à notre politique la prochaine fois.";
                $mail ->AddAddress($row["email"]);
                $mail->SMTPOptions = array('ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
                ));
                $mail->Send();
                print("<script type=\"text/javascript\">location.href=\"gestionreport.php\"</script>");
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


  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</body>
</html>

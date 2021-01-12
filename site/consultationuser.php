<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Supprimer utilisateur</title>
  <link rel="stylesheet" href="gestionusercss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="gestioncss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: brown;
    color: white;
  }
  .search{margin-left:650px;}
  #p1:hover {background-color:yellow;}
  #p3:hover{background-color:red;}
  </style>
  </head>
  <ul>
  <li><a href="demandedajout.php">Demandes d'inscription</a></li>
  <li><a href="gestionuser.php">Creer un utilisateur</a></li>
  <li><a href="type.php">Gestion catégorie</a></li>
  <li><a href="admin.php">Page d'accueil</a></li>
  <div class="dropdown">
    <li><a>List</a></li>
    <div class="dropdown-content">
      <a id="p1" href="signaledusers.php">Signalés</a>
      <a id="p3" href="activate.php">Désactivés </a>
    </div>
  </div>
  <li><a  class="active" href="consultationuser.php">Désactiver un profile</a></li>
  <li><a href="manageaccadd.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
  </ul>
<body id='grad1'>
  <form class="search" action="search.php">
    <input type="submit" value="Rechercher un utilisateur ?" />
  </form>
  <?php
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'base';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    $result = mysqli_query($db,"SELECT * FROM user WHERE visible=1");
    while($row = mysqli_fetch_array($result)){
      echo '<div class="card">';
      echo  "<h1>Nom: " . $row['nom'] . "</h1>";
      echo  "<h1>Prenom: " . $row['prenom'] . "</h1>";
      echo  '<p class="adress">Numero de téléphone: ' . $row['phone'] . '</p>';
      echo  '<p class="adress">Email: ' . $row['email'] . '</p>';
      echo  '<p class="adress">Address: ' . $row['adress'] . '</p>';
      echo  '<p class="username">username : '. $row['username'] . '</p>';
      echo '<form action="consultationuser.php" method="post">
      <input type="hidden"  value="' . $row['id']  . '" name="hid">
      <input type="hidden"  value="' . $row['email']  . '" name="mail">
      <input class="butt" type="submit" value="Désactiver" name="supprimer">
      </form>';
      echo '</div>';
    }
    if(isset($_POST['supprimer'])){
      $id=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
      $mailto=mysqli_real_escape_string($db,htmlspecialchars($_POST['mail']));
      $requete = "UPDATE user set visible=0 where id = '".$id."'  ";
      $exec_requete = mysqli_query($db,$requete);
      if($exec_requete){
        $message = "Profile d'utilisateur désactiver";
        echo "<script type='text/javascript'>alert('$message');</script>";
        //print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");
      }
      else{
        $message = "Error.. please try again";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");
      }
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
      $mail ->Body = "SORRY YOUR ACCOUNT HAS BEEN DELETED";
      $mail ->AddAddress($mailto);
      $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      ));
      print("<script type=\"text/javascript\">location.href=\"consultationuser.php\"</script>");
    }
  ?>
</body>
</html>

<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>MadinaTech - Page d'accueil</title>
    <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
    <style>
    li a.active {
      background-color: blue;
      color: white;
    }
    #p1:hover {background-color:green;}
    #p2:hover {background-color:red;}
    </style>
  </head>
  <ul>
    <li><a href="announce.php">Ecrire une annonce</a></li>
    <div class="dropdown">
      <li><a>Consulter les annonces</a></li>
      <div class="dropdown-content">
        <a id="p1" href="viewann.php">Nouveaux </a>
        <a id="p2" href="annrej.php">Rejetées </a>
      </div>
    </div>
    <li><a href="statauth.php">Statiques</a></li>
    <li><a class="active" href="auth.php">Page d'accueil</a></li>
    <li><a href="declared.php">Consulter les nouveaux signalements</a></li>
    <li><a href="encours.php">Consulter les signalements en cours</a></li>
    <li><a href="finished.php">Consulter les signalements terminé</a></li>
    <li><a href="manageaccau.php">Paramètres de compte</a></li>
    <li><a href="log.php">Se déconnecter</a></li>
  </ul>
<div id="content2" style="margin-left:25%;padding:1px 16px;height:1000px;">
	<?php
	if($_SESSION['username'] !== ""){
		$user = $_SESSION['username'];
		// afficher un message
		echo "Bonjour $user, vous êtes authority";
		}
    if(empty($_SESSION['username'])) header('Location: log.php');
  $db_username = 'root';
  $db_password = '';
  $db_name     = 'base';
  $db_host     = 'localhost';
  $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
         or die('could not connect to database');
  if(isset($_POST['almost'])){
  $report = $_SESSION['treat'];
  $requete = "UPDATE signalement SET etat = 2  where id = '".$report."' ";
  $requete2 = "UPDATE signalement SET date2 = NOW()  where id = '".$report."' ";
  $exec_requete = mysqli_query($db,$requete);
  $exec_requete = mysqli_query($db,$requete2);
  $message = "Signalement lencé";
  echo "<script type='text/javascript'>alert('$message');</script>";
  }
  if(isset($_POST['done'])){
  $report = $_SESSION['treat'];
  $requete = "UPDATE signalement SET etat = 3  where id = '".$report."' ";
  $requete2 = "UPDATE signalement SET date3 = NOW()  where id = '".$report."' ";
  $exec_requete = mysqli_query($db,$requete);
  $exec_requete = mysqli_query($db,$requete2);
  $message = "Signalement cloturé";
  echo "<script type='text/javascript'>alert('$message');</script>";
  }
  ?>
 </div>

</body>
</html>

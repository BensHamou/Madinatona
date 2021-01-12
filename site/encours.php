<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Signalements en cours</title>
    <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
    <style>
    li a.active {
      background-color: orange;
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
    <li><a href="auth.php">Page d'accueil</a></li>
    <li><a href="declared.php">Consulter les nouveaux signalements</a></li>
    <li><a class="active" href="encours.php">Consulter les signalements en cours</a></li>
    <li><a href="finished.php">Consulter les signalements terminé</a></li>
    <li><a href="manageaccau.php">Paramètres de compte</a></li>
    <li><a href="log.php">Se déconnecter</a></li>
  </ul>
<body id='grad1'>
  <form action="treatreport.php" method="POST">
    <?php
    if($_SESSION['type'] !== ""){
      $type = $_SESSION['type'];
    }
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'base';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    $result = mysqli_query($db,"SELECT * FROM signalement where signalement.type = '".$type."' and signalement.etat = 2 and signalement.visible=2 ORDER by priority desc, date1 desc");
    while($row = mysqli_fetch_array($result)){
      echo '<div class="card" >';
      echo  "<h1> Titre: ". $row['title'] . "</h1>";
      echo  '<img src="'.$row['image'].'" alt  = "No photo for this report." style="width:100%">';
      echo  '<p class="date">à: ' . $row['date1'] . '</p>';
      echo  "<h1>" . $row['description'] . "</h1>";
      echo  '<p class="adress">Lieu: ' . $row['adress'] . '</p>';
      echo  '<p class="username">par: '. $row['username'] . '</p>';
      if(!empty( $row['rapport'])){
      echo  "<h1> Rapport: " . $row['rapport'] . "</h1>";
      }
      if(!empty( $row['imagerapport'])){
        echo  '<img src="'.$row['imagerapport'].'" alt  = "No rapport photo for this report." style="width:100%">';
      }
      echo  '<button type="submit" name="treat"  value="'.$row['id'].'" class="button">Traiter</button>';
      echo '</div>';
    }
    ?>
  </form>
</div>
</body>
</html>
